<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository extends EloquentRepository
{
    public function getModel(): Order
    {
        return new Order();
    }
}
