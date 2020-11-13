<?php

declare(strict_types=1);

namespace App\Core\Product;

use App\Core\Product\Exceptions\InvalidProductNameException;
use JsonSerializable;

final class ProductName implements JsonSerializable
{
    public const MIN_LENGTH = 3;
    public const MAX_LENGTH = 32;

    private $value;

    /**
     * @param $value
     * @throws InvalidProductNameException
     */
    public function __construct($value)
    {
        if (!is_string($value)) {
            throw new InvalidProductNameException($value);
        }

        $length = mb_strlen($value);
        if ($length < self::MIN_LENGTH || $length > self::MAX_LENGTH) {
            throw new InvalidProductNameException($value);
        }

        $this->value = $value;
    }

    /**
     * @param string $value
     * @return static
     * @throws InvalidProductNameException
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
