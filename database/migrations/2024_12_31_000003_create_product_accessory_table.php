<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Pivot table linking products to their available accessories
        Schema::create('product_accessory', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('accessory_id');
            $table->boolean('is_default')->default(false); // Pre-selected accessory
            $table->boolean('is_required')->default(false); // Must select one from this type
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('accessory_id')->references('id')->on('accessories')->onDelete('cascade');
            
            $table->unique(['product_id', 'accessory_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_accessory');
    }
};
