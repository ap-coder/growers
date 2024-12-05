<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('number')->nullable();
            $table->string('status')->nullable();
            $table->float('shipping_cost', 15, 2)->nullable();
            $table->float('order_total', 15, 2)->nullable();
            $table->float('total_price', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
