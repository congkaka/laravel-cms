<?php

namespace App\Enums;

enum BlogStatus: string
{
    case PUBLISHED = 'PUBLISHED';
    case DRAFT = 'DRAFT';
    case PENDING = 'PENDING';

    public static function getMap(): array
    {
        return [
            self::PUBLISHED->value => 'Published',
            self::DRAFT->value => 'Draft',
            self::PENDING->value => 'Pending'
        ];
    }
}
