<?php

namespace App\Import;

class ProductValidator
{
    private array $errors = [];

    public function validate(array $row): bool
    {
        $this->errors = [];

        if (empty($row['Product Code']) ||
            empty($row['Product Name']) ||
            !isset($row['Cost in GBP']) ||
            !isset($row['Stock']) ||
            !is_numeric($row['Cost in GBP']) ||
            !is_numeric($row['Stock'])) {
            $this->errors[] = 'Missing required fields or non-numeric';
            return false;
        }

        $price = (float) $row['Cost in GBP'];
        $stock = (int) $row['Stock'];

        if ($price < 5 && $stock < 10) {
            $this->errors[] = 'Price < 5 and Stock < 10';
            return false;
        }

        if ($price > 1000) {
            $this->errors[] = 'Price > 1000';
            return false;
        }

        return true;
    }

    public function getLastErrors(): array
    {
        return $this->errors;
    }
}
