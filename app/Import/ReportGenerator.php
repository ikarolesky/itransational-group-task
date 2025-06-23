<?php

namespace App\Import;

class ReportGenerator
{
    protected array $successful = [];
    protected array $skipped = [];
    protected array $errors = [];
    protected array $tested = [];

    public function addSuccess($dto): void
    {
        $this->successful[] = $dto;
    }

    public function addSkipped(array $row, array $reasons): void
    {
        $this->skipped[] = ['row' => $row, 'reasons' => $reasons];
    }

    public function addError($dto, string $error): void
    {
        $this->errors[] = ['dto' => $dto, 'error' => $error];
    }

    public function addTested($dto): void
    {
        $this->tested[] = $dto;
    }

    public function getTotalProcessed(): int
    {
        return count($this->successful) + count($this->skipped) + count($this->errors) + count($this->tested);
    }

    public function summaryText(bool $testMode = false): string
    {
        $lines = [
            'Import completed' . ($testMode ? ' (Test Mode)' : ''),
            'Processed: ' . $this->getTotalProcessed(),
            'Successful: ' . count($this->successful),
            'Skipped: ' . count($this->skipped),
            'Errors: ' . count($this->errors),
        ];

        return implode(PHP_EOL, $lines);
    }
}
