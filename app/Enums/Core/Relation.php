<?php

namespace App\Enums\Core;

enum Relation: string {
    case USER = 'user:id,name,email';
}