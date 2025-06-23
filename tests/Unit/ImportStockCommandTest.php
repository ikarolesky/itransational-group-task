<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ImportStockCommandTest extends TestCase
{
    public function testCommandRunsAndOutputsSummary()
    {
        $exit = Artisan::call('stock:import', [
            'file' => base_path('tests/fixtures/sample.csv'),
            '--test' => true,
        ]);

        $output = Artisan::output();

        $this->assertEquals(0, $exit);
        $this->assertStringContainsString('Processed: 6', $output);
        $this->assertStringContainsString('Successful: 3', $output);
        $this->assertStringContainsString('Skipped: 3', $output);
        $this->assertStringContainsString('Import completed (Test Mode)', $output);
    }
}
