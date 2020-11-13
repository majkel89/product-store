<?php

declare(strict_types=1);

namespace App\Application\Product\Queries;

use App\Core\Product\Exceptions\InvalidProductIdException;
use App\Core\Product\Exceptions\ProductNotFoundException;
use App\Core\Product\ProductId;
use App\Core\Product\ProductReadOnlyRepository;
use Symfony\Component\Routing\RouterInterface;

final class GetProductQueryHandler
{
    private $repository;
    private $router;

    public function __construct(ProductReadOnlyRepository $repository, RouterInterface $router)
    {
        $this->repository = $repository;
        $this->router = $router;
    }

    /**
     * @param GetProductQuery $query
     * @return ProductView
     * @throws ProductNotFoundException|InvalidProductIdException
     */
    public function handle(GetProductQuery $query): ProductView
    {
        $productId = ProductId::fromString($query->getId());

        $product = $this->repository->findProduct($productId);

        if (!$product) {
            throw new ProductNotFoundException($productId);
        }

        return new ProductView($product, $this->router);
    }
}
