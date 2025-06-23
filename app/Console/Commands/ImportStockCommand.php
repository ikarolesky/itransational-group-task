<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use League\Csv\Reader;
use League\Csv\Statement;
use App\Import\ProductValidator;
use App\Import\ProductImporter;
use App\Import\ReportGenerator;

class ImportStockCommand extends Command
{
    protected $signature = 'stock:import {file} {--test}';
    protected $description = 'Import stock from a CSV file with business rules';

    public function handle()
    {
        //Get file path and see if --test is enabled
        $path = $this->argument('file');
        $testMode = $this->option('test');

        //Read csv using League/CSV
        $csv = Reader::createFromPath($path, 'r');
        $csv->setHeaderOffset(0);

        $records = Statement::create()->process($csv);

        //Initialize Validator, Importer and Report Generator
        $validator = new ProductValidator();
        $importer = new ProductImporter();
        $report = new ReportGenerator();

        foreach ($records as $row) {
            //Add skipped if validation rules fail
            if (!$validator->validate($row)) {
                $report->addSkipped($row, $validator->getLastErrors());
                continue;
            }

            $dto = $importer->map($row);

            //Switch to test mode
            if ($testMode) {
                $report->addTested($dto);
                continue;
            }

            //Import product
            try {
                $importer->import($dto);
                $report->addSuccess($dto);
            } catch (\Throwable $e) {
                $report->addError($dto, $e->getMessage());
            }
        }

        //Print out report
        $this->info($report->summaryText($testMode));


        return 0;
    }
}
