<?php

namespace App\Domain\Enum;

enum ExpirationTime : string
{
    case NoTime = '0';
    case TenMinutes = '10';
    case Hour = '60';
    case ThreeHours = '180';
    case Day = '1440';
    case Week = '10080';
    case Month = '43200';

    public function title(): string
    {
        return match ($this) {
            ExpirationTime::NoTime => 'Без ограничения',
            ExpirationTime::TenMinutes => '10 минут',
            ExpirationTime::Hour => '1 час',
            ExpirationTime::ThreeHours => '3 часа',
            ExpirationTime::Day => '1 день',
            ExpirationTime::Week => '1 неделя',
            ExpirationTime::Month => '1 месяц',
        };
    }
}
