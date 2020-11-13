<?php
/**
 * Copyright StepStone GmbH
 */

declare(strict_types=1);

namespace App\Core\Product\Exceptions;

use App\Core\ValidationException;

final class InvalidProductNameException extends ValidationException
{
    public function __construct($value)
    {
        parent::__construct("Product name `$value` is not valid");
    }
}
