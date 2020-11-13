<?php

declare(strict_types=1);

namespace App\Core\Product;

use App\Core\Product\Dto\ProductDto;

interface ProductReadOnlyRepository
{
    public function findProduct(ProductId $productId): ?ProductDto;
}
