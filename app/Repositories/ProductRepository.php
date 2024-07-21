<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends EloquentRepository
{
    public function getModel(): Product
    {
        return new Product();
    }
}
