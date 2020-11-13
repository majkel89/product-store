<?php

declare(strict_types=1);

namespace App\Core\Product\Exceptions;

use App\Core\ValidationException;

final class InvalidProductIdException extends ValidationException
{
    public function __construct($productId)
    {
        parent::__construct("Invalid product id `$productId`");
    }
}
