<?php

namespace App\Enums;

enum ListingStatus: string
{
    case PENDING = 'PENDING';
    case ACTIVE = 'ACTIVE';
    case ENDED = 'ENDED';
}
