<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('accessory_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name'); // e.g., "Basket", "Card Holder", "Ribbon"
            $table->text('description')->nullable();
            $table->boolean('published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('accessory_types');
    }
};
