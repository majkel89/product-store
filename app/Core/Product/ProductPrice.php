<?php

declare(strict_types=1);

namespace App\Core\Product;

use App\Core\Product\Exceptions\InvalidProductPriceException;
use JsonSerializable;

final class ProductPrice implements JsonSerializable
{
    public const MIN_LENGTH = 3;
    public const MAX_LENGTH = 32;

    private $value;

    /**
     * @param $value
     * @throws InvalidProductPriceException
     */
    public function __construct($value)
    {
        if (!is_float($value)) {
            throw new InvalidProductPriceException($value);
        }

        $this->value = (float) $value;
    }

    /**
     * @param string $value
     * @return static
     * @throws InvalidProductPriceException
     */
    public static function fromString(string $value): self
    {
        return new self($value);
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }

    public function jsonSerialize(): string
    {
        return (string) $this->value;
    }
}
