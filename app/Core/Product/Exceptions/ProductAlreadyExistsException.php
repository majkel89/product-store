<?php

declare(strict_types=1);

namespace App\Core\Product\Exceptions;

use App\Core\Product\ProductId;
use Exception;

final class ProductAlreadyExistsException extends Exception
{
    public function __construct(ProductId $productId)
    {
        parent::__construct("Product already exists $productId");
    }
}
