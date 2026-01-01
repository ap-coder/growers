<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product_bundle_items', function (Blueprint $table) {
            $table->decimal('price_override', 10, 2)->nullable()->after('quantity')
                  ->comment('Custom price for this item when part of bundle (null = use product base price)');
            $table->decimal('price_adjustment', 10, 2)->nullable()->after('price_override')
                  ->comment('Price adjustment (+/-) from base price');
            $table->string('price_type')->default('default')->after('price_adjustment')
                  ->comment('default, override, adjustment, free');
        });
    }

    public function down(): void
    {
        Schema::table('product_bundle_items', function (Blueprint $table) {
            $table->dropColumn(['price_override', 'price_adjustment', 'price_type']);
        });
    }
};
