<?php

declare(strict_types=1);

namespace App\Infrastructure\File;

use App\Core\DomainEvent;
use App\Core\Product\Product;
use App\Core\Product\ProductId;
use App\Core\Product\ProductRepository;

final class FileEventStore implements ProductRepository
{
    public function findProduct(ProductId $id): ?Product
    {
        $events = $this->loadEvents($id->getValue());

        if (!$events) {
            return null;
        }

        return Product::load($events);
    }

    public function storeProduct(Product $product): void
    {
        $aggregateId = $product->getId()->getValue();

        foreach ($product->getChanges() as $event) {
            $this->storeEvent($aggregateId, $event);
        }

        $product->commitChanges();
    }

    /**
     * @param string $id
     * @return DomainEvent[]
     */
    private function loadEvents(string $id): array
    {
        return [];
    }

    private function storeEvent(string $aggregateId, DomainEvent $event): void
    {

    }
}
