<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('show_description_tab')->default(true)->after('show_tabs');
            $table->boolean('show_additional_info_tab')->default(true)->after('show_description_tab');
            $table->boolean('show_shipping_return_tab')->default(true)->after('show_additional_info_tab');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['show_description_tab', 'show_additional_info_tab', 'show_shipping_return_tab']);
        });
    }
};
