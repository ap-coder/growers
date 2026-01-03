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
        Schema::create('variation_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('published')->default(true);
            $table->boolean('is_fake')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
        
        // Update product_variations to use foreign key
        Schema::table('product_variations', function (Blueprint $table) {
            $table->unsignedBigInteger('variation_category_id')->nullable()->after('category');
            $table->foreign('variation_category_id')->references('id')->on('variation_categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_variations', function (Blueprint $table) {
            $table->dropForeign(['variation_category_id']);
            $table->dropColumn('variation_category_id');
        });
        Schema::dropIfExists('variation_categories');
    }
};
