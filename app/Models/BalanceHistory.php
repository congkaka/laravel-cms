<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalanceHistory extends Model
{
    use HasFactory;

    protected $table = 'balance_histories';

    protected $fillable = [
        'user_id',
        'pre_balance',
        'change_balance',
        'after_balance',
        'content'
    ];

    protected $casts = [];
}
