<?php

namespace App\Enums;

enum Meal: string
{
    case BREAKFAST = 'breakfast';
    case SECOND_BREAKFAST = 'second_breakfast';
    case LUNCH = 'lunch';
    case SNACK = 'snack';
    case DINNER = 'dinner';

    public static function ordered(): array
    {
        return [
            self::BREAKFAST,
            self::SECOND_BREAKFAST,
            self::LUNCH,
            self::SNACK,
            self::DINNER,
        ];
    }
}
