<?php

namespace App\Repositories;

use App\Models\Post;

class BlogRepository extends EloquentRepository
{
    public function getModel(): Post
    {
        return new Post();
    }
}
