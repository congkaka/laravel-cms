<?php

namespace App\Http\Controllers\Api;

use App\Enums\MemberLevel;
use App\Enums\OrderStatus;
use App\Enums\ProductType;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Repositories\OrderRepository;
use App\Repositories\ProductVariantRepository;
use App\Repositories\SettingRepository;
use App\Repositories\UserRepository;
use App\Repositories\WalletChangeLogRepository;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ApiOrderController extends Controller
{
    private ProductVariantRepository $productVariantRepository;
    private UserRepository $userRepository;
    private WalletChangeLogRepository $walletChangeLogRepository;
    protected SettingRepository $settingRepository;
    protected OrderRepository $orderRepository;

    public function __construct(
        ProductVariantRepository  $productVariantRepository,
        UserRepository            $userRepository,
        WalletChangeLogRepository $walletChangeLogRepository,
        SettingRepository         $settingRepository,
        OrderRepository           $orderRepository)
    {
        $this->productVariantRepository = $productVariantRepository;
        $this->userRepository = $userRepository;
        $this->walletChangeLogRepository = $walletChangeLogRepository;
        $this->settingRepository = $settingRepository;
        $this->orderRepository = $orderRepository;
    }

    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
        $order = new Order();
        $request->validate(['variant_id' => 'numeric|required|exists:product_variants,id']);
        $variant = $this->productVariantRepository->findById($request['variant_id']);
        if(!$variant->is_active || !$variant->product->is_active){
            return apiErrorRes([], 'Dịch vụ đang bảo trì!', 400);
        }
        $rules = [
            'uid' => 'required',
            'variant_id' => 'numeric|required',
            'note' => ''
        ];
        $rules['quantity'] = "numeric|required|min:$variant->min_sale_quantity|max:$variant->max_sale_quantity";
        if ($variant->product->type == ProductType::BY_TIME) {
            $rules['execution_time'] = 'required|numeric|min:30';
        }
        $data = $request->validate($rules);
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $price = $variant->price;
            if ($user->level == MemberLevel::CTV) {
                $price = $variant->price_ctv;
            }
            if ($user->level == MemberLevel::AGENCY) {
                $price = $variant->price_agency;
            }
            $amount = $price * $request['quantity'] * ($variant->product->type == ProductType::BY_TIME ? $data['execution_time'] : 1);

            if ($user->balance < $amount) {
                return apiErrorRes([], 'Số dư không đủ vui lòng nạp thêm!', 400);
            }

            $order->code = randomCode();
            $order->uid = $this->findUid($data['uid']);
            $order->product_id = $variant->product_id;
            $order->product_variant_id = $variant->id;
            $order->product_variant = $variant->name;
            $order->product = $variant->product->name;
            $order->execution_time = ($variant->product->type == ProductType::BY_TIME) ? $data['execution_time'] : 0;
            $order->user_id = $user->id;
            $order->note = $data['note'];
            $order->quantity = $data['quantity'];
            $order->price = $price;
            $order->amount = $amount;
            $order->status = OrderStatus::PENDING;
            $order->save();

            $this->userRepository->minusWallet($user->id, $order->amount);

            $this->walletChangeLogRepository->addLog(
                $user->id,
                $user->balance,
                $order->amount,
                false,
                sprintf('Đặt đơn hàng <b>%s</b> số lượng <b>%s</b>, tổng thanh toán <b>%s</b>', $order->product . '-' . $variant->name, $order->quantity, $order->amount)
            );
            $this->sendTelegram($order, $user);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return apiErrorRes([], 'Lỗi hệ thống', 500);
        }

        return apiSuccessRes($order, 'Order successfully created!');
    }

    public function findUid($link): string
    {
        $uid = null;
        if ($link && preg_match_all('/\d+/', $link, $matches)) {
            if (strlen(end($matches[0])) > 5) {
                $uid = end($matches[0]);
            }

        }
        if (!$uid) {
            try {
                $res = Http::get('https://ffb.vn/api/tool/get-id-fb', ['idfb' => $link]);
                $uid = $res->json('id');
            } catch (\Exception $e) {
            }
        }
        if (!$uid) {
            $uid = $link;
        }

        return $uid;
    }

    private function sendTelegram(Order $order, User $user): void
    {
        $setting = $this->settingRepository->getFirst();
        $variantName = substr($order->product_variant,0,strlen($order->product_variant) > 20 ? 20 : strlen($order->product_variant));
        $message = "Có đơn hàng: $order->product 🍀 " .
            "\nKhách hàng: $user->username 🦋 " .
            "\nMã đơn hàng: $order->code " .
            "\nSố lượng: $order->quantity - $variantName" .
            "\nThời gian chạy: $order->execution_time " .
            "\nLink ID :  $order->uid " .
            "\nSố tiền: $order->amount";
        sendMessageTelegram($setting['telegram']['token'], $setting['telegram']['chatid'], $message);
    }

    public function filter(Request $request)
    {
        $rules = [
            'keyword' => 'string',
            'product_id' => 'numeric',
            'status' => 'string'
        ];

        $params = $request->validate($rules);

        $user = Auth::user();
        $query = $this->orderRepository->getModel()::query()->where('user_id', $user->id);
        if (isset($params['keyword']) && $params['keyword']) {
            $query->where(function ($query) use ($params) {
                $query->where('code', 'like', '%' . $params['keyword'] . '%')
                    ->orWhere('uid', 'like', '%' . $params['keyword'] . '%');
            });
        }
        if (isset($params['status']) && $params['status']) {
            $query->where('status', $params['status']);
        }
        if (isset($params['product_id']) && $params['product_id']) {
            $query->where('product_variant_id', $params['product_id']);
        }

        $data = $query->paginate();

        return apiPageRes($data);
    }

    public function changeStateAdmin($id, Request $request): \Illuminate\Http\JsonResponse
    {
        $rules = [
            'state' => [Rule::enum(OrderStatus::class),'required']
        ];
        try {
            DB::beginTransaction();
            $order = $this->orderRepository->findById($id);
            $user = $this->userRepository->findById($order->user_id);
            $order->status = $request->get('status');
            $order->save();
            if(OrderStatus::from($request->get('status')) == OrderStatus::CASH_BACK){
                $this->userRepository->plusWallet($order->user_id, $order->amount);
                $this->walletChangeLogRepository->addLog(
                    $order->user_id,
                    $user->balance,
                    $order->amount,
                    true,
                    sprintf('Hoàn tiền đơn hàng <b>%s</b> số lượng <b>%s</b>, tổng thanh toán <b>%s</b>', $order->product . '-' . $order->product_variant, $order->quantity, $order->amount)
                );
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return apiErrorRes([], 'Lỗi hệ thống', 500);
        }

        return apiSuccessRes([], 'Thành công', 200);
    }
}
