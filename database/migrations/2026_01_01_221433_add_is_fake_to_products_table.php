<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_fake')->default(false)->after('published');
        });
        
        Schema::table('product_categories', function (Blueprint $table) {
            $table->boolean('is_fake')->default(false)->after('name');
        });
        
        Schema::table('product_tags', function (Blueprint $table) {
            $table->boolean('is_fake')->default(false)->after('name');
        });
        
        Schema::table('clients', function (Blueprint $table) {
            $table->boolean('is_fake')->default(false)->after('name');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('is_fake');
        });
        
        Schema::table('product_categories', function (Blueprint $table) {
            $table->dropColumn('is_fake');
        });
        
        Schema::table('product_tags', function (Blueprint $table) {
            $table->dropColumn('is_fake');
        });
        
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('is_fake');
        });
    }
};
