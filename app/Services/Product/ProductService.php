<?php

namespace App\Services\Product;

use App\Enums\Core\Database as CoreDatabaseEnum;
use App\Enums\Core\Relation as CoreRelationEnum;
use App\Enums\Product\Database as ProductDatabaseEnum;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    public static function getWithPaginate(): LengthAwarePaginator
    {
        return Product::select(ProductDatabaseEnum::SELECTED_COLUMNS->value())
            ->with(CoreRelationEnum::USER->value)
            ->orderBy("id", CoreDatabaseEnum::DESC_ORDER->value)
            ->paginate((Int) CoreDatabaseEnum::PAGINATION_SIZE->value);
    }
}
