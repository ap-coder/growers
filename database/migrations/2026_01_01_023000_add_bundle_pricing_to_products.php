<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('bundle_price_type')->default('calculated')->after('base_price')
                  ->comment('calculated, fixed, discount_percent, discount_amount');
            $table->decimal('bundle_price_override', 10, 2)->nullable()->after('bundle_price_type')
                  ->comment('Fixed bundle price when bundle_price_type is fixed');
            $table->decimal('bundle_discount', 10, 2)->nullable()->after('bundle_price_override')
                  ->comment('Discount percent or amount based on bundle_price_type');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['bundle_price_type', 'bundle_price_override', 'bundle_discount']);
        });
    }
};
