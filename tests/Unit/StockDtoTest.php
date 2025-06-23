<?php

namespace Tests\Unit;

use App\Import\DTO\StockDto;
use PHPUnit\Framework\TestCase;

class StockDtoTest extends TestCase
{
    public function test_stock_dto_initialization()
    {
        $dto = new StockDto(
            code: "SKU123",
            name: "Test Product",
            description: "Desc",
            stock: 25,
            price: 10.50,
            discontinued: null
        );

        $this->assertEquals("SKU123", $dto->code);
        $this->assertEquals("Test Product", $dto->name);
        $this->assertEquals("Desc", $dto->description);
        $this->assertEquals(25, $dto->stock);
        $this->assertEquals(10.50, $dto->price);
        $this->assertNull($dto->discontinued);
    }
}
