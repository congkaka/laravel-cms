<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository extends EloquentRepository
{
    public function getModel(): User
    {
        return new User();
    }

    public function minusWallet($userId, $total)
    {
        DB::table('users')->where('id','=', $userId)->update(['balance' => DB::raw("balance - $total")]);
    }

    public function plusWallet($userId, $total)
    {
        DB::table('users')->where('id','=', $userId)->update(['balance' => DB::raw("balance + $total")]);
    }
}
