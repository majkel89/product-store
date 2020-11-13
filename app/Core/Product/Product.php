<?php

declare(strict_types=1);

namespace App\Core\Product;

use App\Core\AggregateRoot;
use App\Core\DomainEvent;
use App\Core\Product\Events\ProductCreatedEvent;
use App\Core\Product\Exceptions\InvalidProductStateException;

final class Product extends AggregateRoot
{
    /** @var ProductId */
    private $id;
    /** @var ProductName */
    private $name;
    /** @var ProductPrice */
    private $price;

    private function __construct(int $version = 0)
    {
        parent::__construct($version);
    }

    public static function create(ProductId $id, ProductName $name, ProductPrice $price): self
    {
        $product = new Product();
        $product->apply(new ProductCreatedEvent($id, $name, $price));
        return $product;
    }

    public static function restore(ProductId $id, int $version, ProductName $name, ProductPrice $price): product
    {
        $product = new Product($version);
        $product->id = $id;
        $product->name = $name;
        $product->price = $price;
        return $product;
    }

    public function getId(): ProductId
    {
        return $this->id;
    }

    public function getName(): ProductName
    {
        return $this->name;
    }

    public function getPrice(): ProductPrice
    {
        return $this->price;
    }

    protected function when(DomainEvent $event): void
    {
        if ($event instanceof ProductCreatedEvent) {
            $this->id = $event->getId();
            $this->name = $event->getName();
            $this->price = $event->getPrice();
        }
    }

    /**
     * @throws InvalidProductStateException
     */
    protected function validateState(): void
    {
        if ($this->id === null || $this->name === null || $this->price === null) {
            throw new InvalidProductStateException();
        }
    }
}
