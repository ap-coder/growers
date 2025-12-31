<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('base_price', 10, 2)->nullable()->after('description');
            $table->string('sku')->nullable()->after('base_price');
            $table->string('upc_code')->nullable()->after('sku');
            $table->string('qb_1')->nullable()->after('upc_code')->comment('QuickBooks identifier 1');
            $table->string('qb_2')->nullable()->after('qb_1')->comment('QuickBooks identifier 2');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['base_price', 'sku', 'upc_code', 'qb_1', 'qb_2']);
        });
    }
};
