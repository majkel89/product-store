<?php

declare(strict_types=1);

namespace App\Infrastructure\DynamoDb;

use App\Core\AggregateRoot;
use App\Core\DomainEvent;
use App\Infrastructure\EventProjection;

final class DynamoDbProjection implements EventProjection
{
    public function projectEvent(AggregateRoot $aggregateRoot, DomainEvent $change): void
    {
        // apply change on read model
    }
}
