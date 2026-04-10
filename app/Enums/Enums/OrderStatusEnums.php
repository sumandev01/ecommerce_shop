<?php

namespace App\Enums\Enums;

enum OrderStatusEnums: string
{
    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
}
