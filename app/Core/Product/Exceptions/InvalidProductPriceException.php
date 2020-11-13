<?php

declare(strict_types=1);

namespace App\Core\Product\Exceptions;

use App\Core\ValidationException;

final class InvalidProductPriceException extends ValidationException
{
    public function __construct($value)
    {
        parent::__construct("Product price `$value` is not valid");
    }
}
