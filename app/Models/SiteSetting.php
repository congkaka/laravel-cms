<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $table = 'site_setting';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'facebook',
        'zalo',
        'youtube',
        'instagram',
        'work_time',

        'google_play',
        'appstore',

        'top_menu',
        'main_menu',

        'logo',
        'slide',
        'main_banner',
        'sub_banner',

        'footer',

        'bank',

        'telegram'
    ];

    protected $casts = [
        'slide' => 'array',
        'main_banner' => 'array',
        'sub_banner' => 'array',
        'top_menu' => 'array',
        'main_menu' => 'array',
        'footer' => 'array',
        'bank' => 'array',
        'telegram' => 'array',
    ];
}
