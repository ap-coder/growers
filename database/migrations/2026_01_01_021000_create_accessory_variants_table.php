<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('accessory_variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('accessory_id');
            $table->string('name'); // e.g., "Red - Large", "Blue - Small"
            $table->string('color')->nullable(); // e.g., "Red", "Blue", "Natural"
            $table->string('size')->nullable(); // e.g., "Small", "Medium", "Large"
            $table->string('sku')->nullable(); // Variant-specific SKU
            $table->decimal('price_adjustment', 10, 2)->default(0)->comment('Add/subtract from base price');
            $table->decimal('price_override', 10, 2)->nullable()->comment('Fixed price (overrides base + adjustment)');
            $table->boolean('is_default')->default(false);
            $table->boolean('published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->integer('stock_quantity')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('accessory_id')->references('id')->on('accessories')->onDelete('cascade');
            $table->index(['accessory_id', 'published']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accessory_variants');
    }
};
