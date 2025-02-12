<?php

namespace App\Enums\Product;

enum Database: string
{
    case TABLE_NAME = 'products';
    case SELECTED_COLUMNS = '';

    public function value(): array
    {
        return match($this) {
            self::SELECTED_COLUMNS => [
                self::TABLE_NAME->value . '.id',
                self::TABLE_NAME->value . '.user_id',
                self::TABLE_NAME->value . '.name',
                self::TABLE_NAME->value . '.description',
                self::TABLE_NAME->value . '.price',
                self::TABLE_NAME->value . '.stock',
            ],
        };
    }
}

