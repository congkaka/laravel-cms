<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Admin\CrudController;
use App\Http\Controllers\Api\ApiOrderController;
use App\Http\Requests\OrderCreateRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Repositories\EloquentRepository;
use App\Repositories\OrderRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class OrderController extends CrudController
{
    /**
     * @var OrderRepository
     */
    private OrderRepository $orderRepository;
    private UserRepository $userRepository;
    private ApiOrderController $apiOrderController;

    public function __construct(OrderRepository $orderRepository, UserRepository $userRepository, ApiOrderController $apiOrderController)
    {
        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
        $this->apiOrderController = $apiOrderController;
    }

    /**
     * @return OrderRepository
     */
    public function getRepository(): EloquentRepository
    {
        return $this->orderRepository;
    }

    public function getViewFolder(): string
    {
        return 'admin.order';
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $data = [])
    {
        $items = $this->getRepository()->queryBuilder();
        if ($request->status) {
            $items->where('status', $request->status);
        }
        if ($request->user_id) {
            $items->where('user_id', $request->user_id);
        }
        if ($request->keyword) {
            $items->whereRaw("(uid like '%$request->keyword%' or code like '%$request->keyword%')");
        }

        $sum = $items->sum('amount');
        $items->orderBy('id', 'desc');

        $items = $items->paginate(15);
        $data['items'] = $items;
        $data['sum'] = $sum;
        $data['users'] = $this->userRepository->getAll([], ['id', 'name', 'username']);

        return view($this->getViewWithFolder('index'), $data);
    }

    public function changeState($id, Request $request){
        $res = $this->apiOrderController->changeStateAdmin($id, $request);
        return back()->with($res->original['success'] == 200 ? 'success': 'error', $res->original['message']);
    }
}
