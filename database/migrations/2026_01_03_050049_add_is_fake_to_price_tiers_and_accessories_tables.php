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
        Schema::table('product_price_tiers', function (Blueprint $table) {
            $table->boolean('is_fake')->default(false)->after('sort_order');
        });
        
        Schema::table('accessories', function (Blueprint $table) {
            $table->boolean('is_fake')->default(false)->after('sort_order');
        });
        
        Schema::table('accessory_types', function (Blueprint $table) {
            $table->boolean('is_fake')->default(false)->after('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_price_tiers', function (Blueprint $table) {
            $table->dropColumn('is_fake');
        });
        
        Schema::table('accessories', function (Blueprint $table) {
            $table->dropColumn('is_fake');
        });
        
        Schema::table('accessory_types', function (Blueprint $table) {
            $table->dropColumn('is_fake');
        });
    }
};
