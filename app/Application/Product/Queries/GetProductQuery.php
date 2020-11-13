<?php

declare(strict_types=1);

namespace App\Application\Product\Queries;

final class GetProductQuery
{
    private $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
