<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Individual tab visibility flags for the product detail page
            if (!Schema::hasColumn('products', 'show_description_tab')) {
                $table->boolean('show_description_tab')->default(true)->after('description');
            }
            if (!Schema::hasColumn('products', 'show_additional_info_tab')) {
                $table->boolean('show_additional_info_tab')->default(true)->after('show_description_tab');
            }
            if (!Schema::hasColumn('products', 'show_shipping_return_tab')) {
                $table->boolean('show_shipping_return_tab')->default(true)->after('show_additional_info_tab');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'show_shipping_return_tab')) {
                $table->dropColumn('show_shipping_return_tab');
            }
            if (Schema::hasColumn('products', 'show_additional_info_tab')) {
                $table->dropColumn('show_additional_info_tab');
            }
            if (Schema::hasColumn('products', 'show_description_tab')) {
                $table->dropColumn('show_description_tab');
            }
        });
    }
};
