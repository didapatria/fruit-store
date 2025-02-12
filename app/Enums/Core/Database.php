<?php

namespace App\Enums\Core;

enum Database: string
{
    case PAGINATION_SIZE = '10';
    case DESC_ORDER = 'DESC';
    case ASC_ORDER = 'ASC';
}