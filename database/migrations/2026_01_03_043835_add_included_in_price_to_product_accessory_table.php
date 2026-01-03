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
        Schema::table('product_accessory', function (Blueprint $table) {
            $table->boolean('included_in_price')->default(false)->after('is_required');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_accessory', function (Blueprint $table) {
            $table->dropColumn('included_in_price');
        });
    }
};
