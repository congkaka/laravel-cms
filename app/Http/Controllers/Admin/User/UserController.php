<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Admin\CrudController;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Repositories\EloquentRepository;
use App\Repositories\UserRepository;
use App\Repositories\WalletChangeLogRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends CrudController
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    private WalletChangeLogRepository $walletChangeLogRepository;

    public function __construct(UserRepository $userRepository, WalletChangeLogRepository $walletChangeLogRepository)
    {
        $this->userRepository = $userRepository;
        $this->walletChangeLogRepository = $walletChangeLogRepository;
    }

    /**
     * @return UserRepository
     */
    public function getRepository(): EloquentRepository
    {
        return $this->userRepository;
    }

    public function getViewFolder(): string
    {
        return 'admin.user';
    }

    public function walletHistory(Request $request)
    {
        $walletChanges = $this->walletChangeLogRepository->getPaginate($request);

        return view($this->getViewWithFolder('wallet_history'), compact('walletChanges'));
    }

    public function decentralization(Request $request)
    {
        // $role = Role::create(['name' => 'admin']);
        // $permission = Permission::create(['name' => 'Blogs manager']);

        // $role = Role::find(1);
        // $permission = Permission::find(4);

        // $role->givePermissionTo($permission);
        

        $user = User::find($request->user_id);
        $permissions = Permission::all();
        if ($request->isMethod('post')) {
            $permissionList = $request->permission_list;
            if ($permissionList) $user->syncPermissions($permissionList);
        }
        return view($this->getViewWithFolder('decentralization'), compact('user', 'permissions'));
    }

    /**
     * Validate form update
     * @param Request $request
     * @param int $id
     * @return array
     */
    public function updateValidated(Request $request, int $id): array
    {
        return $request->except(['_token', 'balance']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $data = $this->updateValidated($request, $id);

        DB::transaction(function () use ($request, $id, $data) {
            $user = $this->userRepository->findById($id);
            if($request->get('add')){
                $this->userRepository->plusWallet($user->id, $request->get('add'));
                $this->walletChangeLogRepository->addLog($user->id, $user->balance ? $user->balance : 0, $request->get('add'), true, 'Cộng bởi ' . Auth::user()->username);
            }
            $this->getRepository()->update($id, $data);
        }, 5);

        return $this->redirectPage('index')->with('success', 'Thao tác thành công.');
    }
}
