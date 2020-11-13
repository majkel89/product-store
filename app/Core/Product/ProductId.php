<?php

declare(strict_types=1);

namespace App\Core\Product;

use App\Core\Product\Exceptions\InvalidProductIdException;
use JsonSerializable;
use Ramsey\Uuid\Guid\Guid;

final class ProductId implements JsonSerializable
{
    private $value;

    /**
     * @param $value
     * @throws InvalidProductIdException
     */
    public function __construct($value)
    {
        if (!is_string($value) || !Guid::isValid($value)) {
            throw new InvalidProductIdException($value);
        }

        $this->value = $value;
    }

    /**
     * @param string $value
     * @return static
     * @throws InvalidProductIdException
     */
    public static function fromString(string $value): self
    {
        return new self($value);
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function jsonSerialize(): string
    {
        return $this->value;
    }
}
