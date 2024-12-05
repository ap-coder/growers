<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('gtin')->nullable();
            $table->string('sku')->nullable();
            $table->string('mpn')->nullable();
            $table->float('price', 15, 2)->nullable();
            $table->integer('quantity')->nullable();
            $table->float('total_price', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
