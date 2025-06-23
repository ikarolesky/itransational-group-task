<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'tblProductData';

    protected $fillable = [
        'strProductCode',
        'strProductName',
        'strProductDesc',
        'price',
        'stock',
        'discontinued_at',
    ];

    public $timestamps = false;
}
