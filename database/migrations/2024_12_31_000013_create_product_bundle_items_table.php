<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('product_bundle_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bundle_product_id')->comment('The set/bundle product');
            $table->unsignedBigInteger('item_product_id')->comment('Product included in the bundle');
            $table->integer('quantity')->default(1);
            $table->boolean('is_required')->default(true)->comment('Must be included in bundle');
            $table->boolean('is_selectable')->default(false)->comment('Customer can choose from options');
            $table->string('group_name')->nullable()->comment('Group for selectable options (e.g., Choose your basket)');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            
            $table->foreign('bundle_product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('item_product_id')->references('id')->on('products')->onDelete('cascade');
            $table->index(['bundle_product_id', 'group_name']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_bundle_items');
    }
};
