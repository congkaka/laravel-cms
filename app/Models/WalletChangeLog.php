<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletChangeLog extends Model
{
    use HasFactory;

    protected $table = 'wallet_change_log';

    protected $fillable = [
        'wallet_pre',
        'wallet_after',
        'wallet_change',
        'is_plus',
        'user_id',
        'content'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
