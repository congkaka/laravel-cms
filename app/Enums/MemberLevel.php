<?php

namespace App\Enums;

enum MemberLevel: string
{
    case ADMIN = 'ADMIN';
    case WRITER = 'WRITER';

    public static function getMap(): array
    {
        return [
            self::ADMIN->value => 'Admin',
            self::WRITER->value => 'Writer'
        ];
    }
}
