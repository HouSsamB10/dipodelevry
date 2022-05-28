<?php

namespace App\Enums;


enum productTypes: string
{
    case DRAFT = 'draft';
    case  PUBLISHED= 'published';
    case ARCHIVED = 'archived';
    case PENDING = 'pending';

}
