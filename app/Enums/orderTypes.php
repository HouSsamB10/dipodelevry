<?php

namespace App\Enums;


enum orderTypes: string
{
    case PENDING = 'pending';
    case REFUNDED = 'refunded';
    case COMPLETED = 'completed';
    case SHIPPED = 'shipped';
    case CANCELED = 'canceled';
}
