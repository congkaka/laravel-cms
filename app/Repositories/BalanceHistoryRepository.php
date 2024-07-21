<?php

namespace App\Repositories;

use App\Models\BalanceHistory;

class BalanceHistoryRepository extends EloquentRepository
{
    public function getModel(): BalanceHistory
    {
        return new BalanceHistory();
    }
}
