<?php

namespace App\Repositories;

use App\Models\SiteSetting;
use Illuminate\Database\Eloquent\Model;

class SettingRepository extends EloquentRepository
{
    public function getModel(): Model
    {
        return new SiteSetting();
    }
}
