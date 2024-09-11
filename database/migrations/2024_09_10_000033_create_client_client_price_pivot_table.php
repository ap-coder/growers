<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientClientPricePivotTable extends Migration
{
    public function up()
    {
        Schema::create('client_client_price', function (Blueprint $table) {
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id', 'client_id_fk_9986807')->references('id')->on('clients')->onDelete('cascade');
            $table->unsignedBigInteger('client_price_id');
            $table->foreign('client_price_id', 'client_price_id_fk_9986807')->references('id')->on('client_prices')->onDelete('cascade');
        });
    }
}
