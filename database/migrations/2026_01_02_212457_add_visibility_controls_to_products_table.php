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
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('show_original_price')->default(true)->after('full_price');
            $table->boolean('show_variations')->default(true)->after('show_original_price');
            $table->boolean('show_sets')->default(true)->after('show_variations');
            $table->boolean('show_accessories')->default(true)->after('show_sets');
        });
        
        // Add active/published to product_variations
        Schema::table('product_variations', function (Blueprint $table) {
            $table->boolean('active')->default(true)->after('published');
        });
        
        // Add active to product_bundle_items
        Schema::table('product_bundle_items', function (Blueprint $table) {
            $table->boolean('active')->default(true)->after('sort_order');
        });
        
        // Add active to product_accessory pivot
        Schema::table('product_accessory', function (Blueprint $table) {
            $table->boolean('active')->default(true)->after('is_required');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['show_original_price', 'show_variations', 'show_sets', 'show_accessories']);
        });
        
        Schema::table('product_variations', function (Blueprint $table) {
            $table->dropColumn('active');
        });
        
        Schema::table('product_bundle_items', function (Blueprint $table) {
            $table->dropColumn('active');
        });
        
        Schema::table('product_accessory', function (Blueprint $table) {
            $table->dropColumn('active');
        });
    }
};
