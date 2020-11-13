<?php
/**
 * Copyright StepStone GmbH
 */

declare(strict_types=1);

namespace App\Infrastructure;

use App\Core\AggregateRoot;
use App\Core\DomainEvent;

interface EventProjection
{
    public function projectEvent(AggregateRoot $aggregateRoot, DomainEvent $change): void;
}
