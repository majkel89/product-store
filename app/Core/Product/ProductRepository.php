<?php

declare(strict_types=1);

namespace App\Core\Product;

interface ProductRepository
{
    public function findProduct(ProductId $id): ?Product;

    public function storeProduct(Product $product): void;
}
