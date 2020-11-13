<?php

declare(strict_types=1);

namespace App\Core\Product\Events;

use App\Core\DomainEvent;
use App\Core\Product\ProductId;
use App\Core\Product\ProductName;
use App\Core\Product\ProductPrice;

final class ProductCreatedEvent implements DomainEvent
{
    /** @var ProductId */
    private $id;
    /** @var ProductName */
    private $name;
    /** @var ProductPrice */
    private $price;

    public function __construct(ProductId $id, ProductName $name, ProductPrice $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
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
}
