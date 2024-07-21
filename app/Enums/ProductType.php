<?php

namespace App\Enums;

enum ProductType: string
{
    case BY_TIME = 'BY_TIME';
    case BASIC = 'BASIC';

    public static function getMap(): array
    {
        return [
            self::BY_TIME->value => 'Theo thời gian',
            self::BASIC->value => 'Không theo thời gian'
        ];
    }
}
