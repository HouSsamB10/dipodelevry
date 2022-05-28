<?php


namespace App\Enums;


enum cartTypes: string
{
    case ACTIVE = 'active';
    case ABONDONED = 'abondoned';
    case ORDERED = 'ordered';
}

