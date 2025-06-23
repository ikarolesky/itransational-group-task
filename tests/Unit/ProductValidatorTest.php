<?php

namespace Tests\Unit;

use App\Import\ProductValidator;
use PHPUnit\Framework\TestCase;

class ProductValidatorTest extends TestCase
{
    private ProductValidator $validator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->validator = new ProductValidator();
    }

    public function test_valid_product_passes_validation()
    {
        $row = [
            'Product Code' => 'ABC',
            'Product Name' => 'Prod',
            'Cost in GBP' => '20',
            'Stock' => '15',
        ];
        $this->assertTrue($this->validator->validate($row));
    }

    public function test_invalid_missing_fields()
    {
        $row = ['Cost in GBP' => '10'];
        $this->assertFalse($this->validator->validate($row));
    }

    public function test_skip_low_price_low_stock()
    {
        $row = [
            'Product Code' => 'X',
            'Product Name' => 'Y',
            'Cost in GBP' => '4',
            'Stock' => '9',
        ];
        $this->assertFalse($this->validator->validate($row));
    }

    public function test_skip_high_price()
    {
        $row = [
            'Product Code' => 'Z',
            'Product Name' => 'W',
            'Cost in GBP' => '2000',
            'Stock' => '5',
        ];
        $this->assertFalse($this->validator->validate($row));
    }
}
