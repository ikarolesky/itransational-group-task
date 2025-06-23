<?php

namespace Tests\Unit;

use App\Import\ReportGenerator;
use PHPUnit\Framework\TestCase;

class ReportGeneratorTest extends TestCase
{
    public function test_summaryText_outputs_correct_summary(): void
    {
        $report = new ReportGenerator();

        $dto = (object)['name' => 'Product A'];

        $report->addSuccess($dto);
        $report->addSkipped(['name' => 'Product B'], ['Too cheap']);
        $report->addError($dto, 'DB Error');
        $report->addTested($dto);

        $summary = $report->summaryText(true); // Test mode enabled

        $this->assertStringContainsString('Import completed (Test Mode)', $summary);
        $this->assertStringContainsString('Processed: 4', $summary);
        $this->assertStringContainsString('Successful: 1', $summary);
        $this->assertStringContainsString('Skipped: 1', $summary);
        $this->assertStringContainsString('Errors: 1', $summary);
    }
}
