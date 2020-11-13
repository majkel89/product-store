<?php

declare(strict_types=1);

namespace App\Infrastructure\Redis;

use App\Core\Product\Exceptions\InvalidProductIdException;
use App\Core\Product\Exceptions\InvalidProductNameException;
use App\Core\Product\Exceptions\InvalidProductPriceException;
use App\Core\Product\Exceptions\ProductAlreadyExistsException;
use App\Core\Product\Product;
use App\Core\Product\ProductId;
use App\Core\Product\ProductName;
use App\Core\Product\ProductPrice;
use App\Core\Product\ProductRepository;
use JsonException;
use Predis\ClientInterface;

final class RedisProductRepository implements ProductRepository
{
    private $redis;

    public function __construct(ClientInterface $redis)
    {
        $this->redis = $redis;
    }

    /**
     * @param ProductId $id
     * @return Product|null
     * @throws JsonException
     * @throws InvalidProductPriceException
     * @throws InvalidProductNameException
     * @throws InvalidProductIdException
     */
    public function findProduct(ProductId $id): ?Product
    {
        $recordData = $this->redis->get($id->getValue());

        if (!$recordData) {
            return null;
        }

        $record = json_decode($recordData, false, 512, JSON_THROW_ON_ERROR);

        return Product::restore(
            ProductId::fromString($record->id),
            $record->version,
            ProductName::fromString($record->name),
            ProductPrice::fromString($record->price)
        );
    }

    /**
     * @param Product $product
     * @throws ProductAlreadyExistsException
     * @throws JsonException
     */
    public function storeProduct(Product $product): void
    {
        $record = new RedisProductModel();
        $record->id = $product->getId()->getValue();
        $record->name = $product->getName()->getValue();
        $record->price = $product->getPrice()->getValue();
        $record->version = $product->getVersion();

        if (!$this->redis->setnx($product->getId(), json_encode($record, JSON_THROW_ON_ERROR))) {
            throw new ProductAlreadyExistsException($product->getId());
        }
    }
}
