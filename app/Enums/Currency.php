<?php

namespace App\Enums;

use App\Enums\StringEnum;

enum Currency: string
{
    use StringEnum;

    /** Euros */
    case EUR = 'EUR';
    /** United States Dollars */
    case USD = 'USD';

    public function symbol(): string
    {
        return match ($this) {
            Currency::EUR => '€',
            Currency::USD => '$',
        };
    }
}
