<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_variations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('name'); // e.g., "Small 8\"", "Medium 10\"", "Large 12\""
            $table->string('sku')->nullable(); // Variation-specific SKU
            $table->string('upc_code')->nullable(); // Variation-specific UPC
            $table->decimal('base_price', 10, 2)->nullable(); // Selling price for this variation
            $table->decimal('base_cost', 10, 2)->nullable(); // Cost tracking (owner only)
            $table->integer('sort_order')->default(0);
            $table->boolean('published')->default(true);
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
        
        // Add base_cost to products table for products without variations
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('base_cost', 10, 2)->nullable()->after('base_price');
        });
        
        // Client-specific pricing for variations
        Schema::create('variation_client_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('variation_id');
            $table->unsignedBigInteger('client_id');
            $table->decimal('price', 10, 2)->nullable();
            $table->timestamps();
            
            $table->foreign('variation_id')->references('id')->on('product_variations')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->unique(['variation_id', 'client_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variation_client_prices');
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('base_cost');
        });
        Schema::dropIfExists('product_variations');
    }
};
