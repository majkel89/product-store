<?php

declare(strict_types=1);

namespace App\Core\Product\Exceptions;

use Exception;

final class InvalidProductStateException extends Exception
{
    public function __construct()
    {
        parent::__construct("Product state is invalid");
    }
}
