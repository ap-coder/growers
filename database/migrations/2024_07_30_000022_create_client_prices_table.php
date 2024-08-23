<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientPricesTable extends Migration
{
    public function up()
    {
        Schema::create('client_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('price', 15, 2)->nullable();
            $table->string('sku')->nullable();
            $table->string('mpn')->nullable();
            $table->string('gtin')->nullable();
            $table->string('upc')->nullable();
            $table->string('qb_1')->nullable();
            $table->string('qb_2')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
