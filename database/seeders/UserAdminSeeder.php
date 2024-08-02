<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // dd(Permission::create(['name' => 'Category manager']));
        //Create user account
        $user = User::create([
            'name' => 'congkaka',
            'username' => 'congkaka',
            'level' => \App\Enums\MemberLevel::ADMIN->value,
            'phone' => '0347576968',
            'email' => 'congkaka@gmail.com',
            'is_admin' => true,
            'password' => Hash::make('congkaka123'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        $menuAdmin = config('menu-admin');
        $permissionList = Arr::pluck($menuAdmin, 'text');
        $permissionOther = [
            'decentralization'
        ];
        //Create Permissions List
        $permissionList = array_merge($permissionList, $permissionOther);
        foreach ($permissionList as $permission) {
            Permission::create(['name' => $permission]);
        };
        //Create Roles List
        $enumRoles = (\App\Enums\MemberLevel::getMap());
        foreach ($enumRoles as $key => $role) {
            Role::create(['name' => $key]);
        }
        //Create model_has_permissions
        $user->syncPermissions($permissionList);
        

    }
}
