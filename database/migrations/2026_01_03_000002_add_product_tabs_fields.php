<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->text('additional_info')->nullable()->after('description');
            $table->text('shipping_return')->nullable()->after('additional_info');
            $table->boolean('show_tabs')->default(true)->after('shipping_return');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['additional_info', 'shipping_return', 'show_tabs']);
        });
    }
};
