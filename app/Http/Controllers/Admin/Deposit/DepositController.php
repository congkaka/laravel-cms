<?php

namespace App\Http\Controllers\Admin\Deposit;

use App\Http\Controllers\Admin\CrudController;
use App\Http\Requests\DepositCreateRequest;
use App\Http\Requests\DepositUpdateRequest;
use App\Repositories\EloquentRepository;
use App\Repositories\DepositRepository;
use App\Repositories\UserRepository;
use App\Repositories\WalletChangeLogRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepositController extends CrudController
{
    /**
     * @var DepositRepository
     */
    private DepositRepository $depositRepository;
    private UserRepository $userRepository;
    private WalletChangeLogRepository $walletChangeLogRepository;

    public function __construct(DepositRepository $depositRepository, UserRepository $userRepository, WalletChangeLogRepository $walletChangeLogRepository){
        $this->depositRepository = $depositRepository;
        $this->userRepository = $userRepository;
        $this->walletChangeLogRepository = $walletChangeLogRepository;
    }

    /**
     * @return DepositRepository
     */
    public function getRepository(): EloquentRepository
    {
        return $this->depositRepository;
    }

    public function getViewFolder(): string
    {
        return 'admin.deposit';
    }

    public function createRequest(Request $request){
        request()->validate([
            'amount' => ['required', 'integer', 'min:10000']
        ]);

        $data = [
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'code' => randomCode(),
            'status' => 'PENDING',
        ];

        $this->depositRepository->create($data);

        return $data;
    }

    function changeStatus($id,Request  $request){
        request()->validate([
            'status' => ['required']
        ]);

        DB::transaction(function () use ($request, $id) {
            $deposit = $this->depositRepository->findById($id);
            if($deposit->status !== 'PENDING' || $request->status !== 'FINISH' && $request->status !== 'CANCEL'){
                return;
            }
            $deposit->status = $request->status;
            $deposit->save();

            if($request->status === 'FINISH'){
                $user = $this->userRepository->findById($deposit->user_id);
                $this->userRepository->plusWallet($user->id, $deposit->amount);
                $this->walletChangeLogRepository->addLog($deposit->user_id, $user->balance ? $user->balance : 0, $deposit->amount, true, 'Nạp qua tài khoản ngân hàng');
            }
        }, 5);

        return $this->redirectPage('index')->with('success', 'Thao tác thành công.');
    }
}
