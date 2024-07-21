<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository extends EloquentRepository
{
    public function getModel(): Model
    {
        return new Category();
    }
}
