<?php

namespace App\Repositories;

use App\Models\ProductVariant;

class ProductVariantRepository extends EloquentRepository
{
    public function getModel(): ProductVariant
    {
        return new ProductVariant();
    }
}
