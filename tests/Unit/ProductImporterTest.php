<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Import\ProductImporter;
use App\Import\DTO\StockDto;
use App\Models\Product;
use Tests\TestCase;

class ProductImporterTest extends TestCase
{
    use RefreshDatabase;

    public function test_map_sets_discontinued()
    {
        $importer = new ProductImporter();
        $row = [
            'Product Code' => 'P1',
            'Product Name' => 'N',
            'Product Description' => 'D',
            'Stock' => '5',
            'Cost in GBP' => '20',
            'Discontinued' => 'yes'
        ];
        $dto = $importer->map($row);
        $this->assertNotNull($dto->discontinued);
    }

    public function test_import_persists_product()
    {
        $dto = new StockDto("P2", "Name", "Desc", 10, 99.9, null);
        $product = (new ProductImporter())->import($dto);

        $this->assertDatabaseHas('tblProductData', [
            'strProductCode' => 'P2',
            'price' => 99.9,
        ]);
    }
}
