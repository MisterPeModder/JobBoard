<?php

namespace App\Enums;

use App\Enums\StringEnum;

enum JobType: string
{
    use StringEnum;

    case FullTime = 'full_time';
    case PartTime = 'part_time';
    case Internship = 'internship';
    case Apprenticeship = 'apprenticeship';
}
