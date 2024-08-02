<?php

namespace App\Repositories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Model;

class StoreRepository extends EloquentRepository
{
    public function getModel(): Model
    {
        return new Store();
    }
}
