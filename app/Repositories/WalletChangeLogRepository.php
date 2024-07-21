<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Transaction;
use App\Models\WalletChangeLog;

class WalletChangeLogRepository extends EloquentRepository
{
    public function getModel(): WalletChangeLog
    {
        return new WalletChangeLog();
    }

    public function addLog($userId,$preWallet, $walletChange, $isPlus, $content)
    {
        $data = [
            'wallet_pre' => $preWallet,
            'wallet_after' => $isPlus ? $preWallet + $walletChange : $preWallet - $walletChange,
            'wallet_change' => $walletChange,
            'is_plus' => $isPlus,
            'user_id' => $userId,
            'content' => $content,
        ];

        $this->create($data);
    }

    public function findByUserId($userId)
    {
        return $this->_model::query()->where('user_id','=',$userId)->orderByDesc('id')->get();
    }
}
