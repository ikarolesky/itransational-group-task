<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTblProductDataAddPriceAndStock extends Migration
{
    public function up(): void
    {
        Schema::table('tblProductData', function (Blueprint $table) {
            $table->decimal('price', 10, 2)->nullable()->after('dtmDiscontinued');
            $table->integer('stock')->nullable()->after('price');
            $table->date('discontinued_at')->nullable()->after('stock');
        });
    }

    public function down(): void
    {
        Schema::table('tblProductData', function (Blueprint $table) {
            $table->dropColumn(['price', 'stock', 'discontinued_at']);
        });
    }
}
