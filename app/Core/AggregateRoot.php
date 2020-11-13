<?php

declare(strict_types=1);

namespace App\Core;

abstract class AggregateRoot
{
    private $changes;
    private $version;

    protected function __construct(int $version = 0, array $changes = [])
    {
        $this->changes = $changes;
        $this->version = $version;
    }

    public static function load(array $events): self
    {
        $aggregateRoot = new static();

        foreach ($events as $event) {
            $aggregateRoot->apply($event);
        }

        $aggregateRoot->commitChanges();

        return $aggregateRoot;
    }

    public function hasChanged(): bool
    {
        return count($this->changes) > 0;
    }

    /**
     * @return DomainEvent[]
     */
    public function getChanges(): array
    {
        return $this->changes;
    }

    public function commitChanges(): void
    {
        $this->changes = [];
    }

    public function getVersion(): int
    {
        return $this->version;
    }

    protected function apply(DomainEvent $event): void
    {
        $this->changes[] = $event;
        $this->version++;

        $this->when($event);

        $this->validateState();
    }

    abstract protected function when(DomainEvent $event): void;

    abstract protected function validateState(): void;
}
