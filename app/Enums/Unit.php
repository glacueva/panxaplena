<?php

namespace App\Enums;

enum Unit: string
{
    case KILOGRAMS = 'kg';
    case GRAMS = 'g';
    case MILIGRAMS = 'mg';

    case UNITS = 'u';

    case LITERS = 'l';
    case CENTILITERS = 'cl';
    case MILILITERS = 'ml';
}
