<?php

namespace App\Enums;

use App\Enums\StringEnum;

enum ApplicationStatus: string
{
    use StringEnum;

    case New = 'new';
    case Accepted = 'accepted';
    case Denied = 'denied';
}
