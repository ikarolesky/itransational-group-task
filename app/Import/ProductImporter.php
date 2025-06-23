<?php

namespace App\Import;

use App\Import\DTO\StockDto;
use App\Models\Product;
use Illuminate\Support\Carbon;

class ProductImporter
{
    public function map(array $row): StockDto
    {
        $discontinued = strtolower($row['Discontinued'] ?? '') === 'yes'
            ? Carbon::now()->toDateString()
            : null;

        return new StockDto(
            code: $row['Product Code'],
            name: $row['Product Name'],
            description: $row['Product Description'] ?? '',
            stock: (int) $row['Stock'],
            price: (float) $row['Cost in GBP'],
            discontinued: $discontinued
        );
    }

    public function import(StockDto $dto): Product
    {
        return Product::create([
            'strProductCode' => $dto->code,
            'strProductName' => $dto->name,
            'strProductDesc' => $dto->description,
            'price' => $dto->price,
            'stock' => $dto->stock,
            'discontinued_at' => $dto->discontinued,
        ]);
    }
}
