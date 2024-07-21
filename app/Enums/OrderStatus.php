<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PENDING = 'PENDING';
    case PROCESSING = 'PROCESSING';
    case CANCEL = 'CANCEL';
    case CASH_BACK = 'CASH_BACK';
    case SUCCESS = 'SUCCESS';

    public static function getMap(): array
    {
        return [
            self::PENDING->value => 'Chờ xử lý',
            self::PROCESSING->value => 'Đang xử lý',
            self::CANCEL->value => 'Hủy',
            self::CASH_BACK->value => 'Hoàn tiền',
            self::SUCCESS->value => 'Hoàn thành'
        ];
    }
}
