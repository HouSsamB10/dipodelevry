<?php 



namespace App\Enums;

enum CartStatus : String 
{
    case ACTIVE = 'active';
    case ABONDONED = 'abondoned';
    case ORDERED = 'ordered';               
}
