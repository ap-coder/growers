<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('product_type')->default('standard')->after('name');
            $table->unsignedBigInteger('accessory_type_id')->nullable()->after('product_type');
            $table->integer('sort_order')->default(0)->after('accessory_type_id');
            
            $table->foreign('accessory_type_id')->references('id')->on('accessory_types')->onDelete('set null');
            $table->index('product_type');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['accessory_type_id']);
            $table->dropColumn(['product_type', 'accessory_type_id', 'sort_order']);
        });
    }
};
