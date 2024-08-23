<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientPriceProductPivotTable extends Migration
{
    public function up()
    {
        Schema::create('client_price_product', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id', 'product_id_fk_9986808')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('client_price_id');
            $table->foreign('client_price_id', 'client_price_id_fk_9986808')->references('id')->on('client_prices')->onDelete('cascade');
        });
    }
}
