<?php

namespace App\Import\DTO;

class StockDto
{
    public function __construct(
        public string $code,
        public string $name,
        public string $description,
        public int $stock,
        public float $price,
        public ?string $discontinued = null
    ) {}
}
