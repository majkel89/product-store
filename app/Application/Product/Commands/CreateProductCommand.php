<?php

declare(strict_types=1);

namespace App\Application\Product\Commands;

final class CreateProductCommand
{
    private $id;
    private $name;
    private $price;

    public function __construct(string $id, ?string $name, ?string $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }
}
