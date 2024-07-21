<?php

namespace App\Repositories;

use App\Models\Deposit;

class DepositRepository extends EloquentRepository
{
    public function getModel(): Deposit
    {
        return new Deposit();
    }
}
