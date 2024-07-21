<?php

namespace App\Http\Controllers\Web\Owlio;

use App\Enums\MemberLevel;
use App\Enums\OrderStatus;
use App\Enums\ProductType;
use App\Http\Controllers\Api\ApiOrderController;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ProductVariantRepository;
use App\Repositories\UserRepository;
use App\Repositories\WalletChangeLogRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    private OrderRepository $orderRepository;
    private ProductRepository $productRepository;
    private ApiOrderController $apiOrderController;

    public function __construct(
        OrderRepository    $orderRepository,
        ProductRepository  $productRepository,
        ApiOrderController $apiOrderController)
    {
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
        $this->apiOrderController = $apiOrderController;
    }

    public function checkout($id)
    {
        $product = $this->productRepository->findById($id);

        return view('themes.owlio.checkout', compact('product'));
    }

    public function create(Request $request)
    {
        $res = $this->apiOrderController->create($request);
        if ($res->getData()->success) {
            return back()->with('success', ' Tạo đơn hàng thành công!');
        }
        return back()->with('error', $res->getData()->message);
    }

    public function history(Request $request)
    {
        $request['size'] = 10;
        $request['user_id'] = Auth::id();

        $orders = $this->orderRepository->getPaginate($request, null);

        return view('themes.owlio.list_order', compact('orders'));
    }
}
