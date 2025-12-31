<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('accessories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('accessory_type_id');
            $table->string('name'); // e.g., "Large Wicker Basket", "Small Card Holder"
            $table->text('description')->nullable();
            $table->string('sku')->nullable();
            $table->decimal('base_price', 10, 2)->nullable(); // Default price if no client-specific price
            $table->boolean('published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('accessory_type_id')->references('id')->on('accessory_types')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('accessories');
    }
};
