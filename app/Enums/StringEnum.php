<?php

namespace App\Enums;

use Illuminate\Support\Arr;

trait StringEnum
{
    /**
     * Returns an array of all the cases of this enum, as strings.
     *
     * @return array<int, string>
     */
    public static function stringCases(): array
    {
        return Arr::map(static::cases(), fn ($case) => $case->value);
    }
}
