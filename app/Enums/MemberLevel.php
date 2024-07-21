<?php

namespace App\Enums;

enum MemberLevel: string
{
    case MEMBER = 'MEMBER';
    case AGENCY = 'AGENCY';
    case CTV = 'CTV';

    public static function getMap(): array
    {
        return [
            self::MEMBER->value => 'Thành viên',
            self::AGENCY->value => 'Đại lý',
            self::CTV->value => 'Cộng tác viên',
        ];
    }
}
