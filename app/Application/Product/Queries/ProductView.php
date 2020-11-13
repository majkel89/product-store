<?php

declare(strict_types=1);

namespace App\Application\Product\Queries;

use App\Core\Product\Dto\ProductDto;
use Symfony\Component\Routing\RouterInterface;

final class ProductView
{
    private $id;
    private $name;
    private $price;
    private $url;

    public function __construct(ProductDto $product, RouterInterface $router)
    {
        $this->id = $product->getId();
        $this->name = $product->getName();
        $this->price = $product->getPrice();

        $this->url = $router->generate('product::get', ['id' => $this->id]);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
