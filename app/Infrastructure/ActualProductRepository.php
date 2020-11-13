<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Core\Product\Product;
use App\Core\Product\ProductId;
use App\Core\Product\ProductRepository;

final class ActualProductRepository implements ProductRepository
{
    private $eventStore;
    private $projection;

    public function __construct(ProductRepository $eventStore, EventProjection $projection)
    {
        $this->eventStore = $eventStore;
        $this->projection = $projection;
    }

    public function findProduct(ProductId $id): ?Product
    {
        return $this->eventStore->findProduct($id);
    }

    public function storeProduct(Product $product): void
    {
        $changes = $product->getChanges();

        $this->eventStore->storeProduct($product);

        foreach ($changes as $change) {
            $this->projection->projectEvent($product, $change);
        }
    }
}
