<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Client-specific pricing for accessories (like ClientPrice for products)
        Schema::create('accessory_client_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('accessory_id');
            $table->unsignedBigInteger('client_id');
            $table->decimal('price', 10, 2);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('accessory_id')->references('id')->on('accessories')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            
            $table->unique(['accessory_id', 'client_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('accessory_client_prices');
    }
};
