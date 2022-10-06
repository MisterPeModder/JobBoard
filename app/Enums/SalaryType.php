<?php

namespace App\Enums;

use App\Enums\StringEnum;

enum SalaryType: string
{
    use StringEnum;

    case Once = 'once';
    case Hourly = 'hourly';
    case Daily = 'daily';
    case Weekly = 'weekly';
    case Monthly = 'monthly';
    case Yearly = 'yearly';
}
