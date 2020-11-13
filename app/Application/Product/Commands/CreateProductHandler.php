<?php

declare(strict_types=1);

namespace App\Application\Product\Commands;

use App\Core\Product\Exceptions\InvalidProductIdException;
use App\Core\Product\Exceptions\InvalidProductNameException;
use App\Core\Product\Exceptions\InvalidProductPriceException;
use App\Core\Product\Exceptions\ProductAlreadyExistsException;
use App\Core\Product\Product;
use App\Core\Product\ProductId;
use App\Core\Product\ProductName;
use App\Core\Product\ProductPrice;
use App\Core\Product\ProductRepository;

final class CreateProductHandler
{
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param CreateProductCommand $command
     * @throws InvalidProductIdException
     * @throws ProductAlreadyExistsException
     * @throws InvalidProductNameException
     * @throws InvalidProductPriceException
     */
    public function handle(CreateProductCommand $command): void
    {
        $productId = ProductId::fromString($command->getId());
        $name = ProductName::fromString($command->getName());
        $price = ProductPrice::fromString($command->getPrice());

        if ($this->repository->findProduct($productId)) {
            throw new ProductAlreadyExistsException($productId);
        }

        $product = Product::create($productId, $name, $price);

        $this->repository->storeProduct($product);
    }
}
