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
        Schema::table('product_variations', function (Blueprint $table) {
            $table->string('description')->nullable()->after('name');
            $table->decimal('full_price', 10, 2)->nullable()->after('base_price');
            $table->string('qb_1')->nullable()->after('quantity');
            $table->string('qb_2')->nullable()->after('qb_1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_variations', function (Blueprint $table) {
            $table->dropColumn(['description', 'full_price', 'qb_1', 'qb_2']);
        });
    }
};
