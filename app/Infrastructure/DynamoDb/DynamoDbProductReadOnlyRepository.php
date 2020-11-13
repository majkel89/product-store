<?php

declare(strict_types=1);

namespace App\Infrastructure\DynamoDb;

use App\Core\Product\Dto\ProductDto;
use App\Core\Product\ProductId;
use App\Core\Product\ProductReadOnlyRepository;

final class DynamoDbProductReadOnlyRepository implements ProductReadOnlyRepository
{
    public function findProduct(ProductId $productId): ?ProductDto
    {
        // TODO: Implement findProduct() method.

        return null;
    }
}
