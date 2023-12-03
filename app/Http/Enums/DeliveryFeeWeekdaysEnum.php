<?php

namespace App\Http\Enums;

final class DeliveryFeeWeekdaysEnum
{
    const WEEKDAY_MONDAY = 0;
    const WEEKDAY_TUESDAY = 0;
    const WEEKDAY_WEDNESDAY = 0;
    const WEEKDAY_THURSDAY = 0;
    const WEEKDAY_FRIDAY = 0;
    const WEEKDAY_SATURDAY = 3;
    const WEEKDAY_SUNDAY = 0;

    const WEEKDAY_MAPPING = [
        0 => self::WEEKDAY_SUNDAY,
        1 => self::WEEKDAY_MONDAY,
        2 => self::WEEKDAY_TUESDAY,
        3 => self::WEEKDAY_WEDNESDAY,
        4 => self::WEEKDAY_THURSDAY,
        5 => self::WEEKDAY_FRIDAY,
        6 => self::WEEKDAY_SATURDAY,
    ];
}
