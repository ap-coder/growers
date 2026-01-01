<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_collections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('layout_type')->default('grid'); // grid, masonry, carousel, tiles, etc.
            $table->boolean('published')->default(false);
            $table->boolean('show_on_homepage')->default(false);
            $table->integer('sort_order')->default(0);
            $table->string('background_color')->nullable();
            $table->string('text_color')->nullable();
            $table->integer('columns')->default(4); // for grid layouts
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('product_collection_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_collection_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();

            $table->foreign('product_collection_id')->references('id')->on('product_collections')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unique(['product_collection_id', 'product_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_collection_items');
        Schema::dropIfExists('product_collections');
    }
};
