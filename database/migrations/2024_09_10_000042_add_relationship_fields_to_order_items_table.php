<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOrderItemsTable extends Migration
{
    public function up()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id', 'product_fk_9986962')->references('id')->on('products');
            $table->unsignedBigInteger('items_id')->nullable();
            $table->foreign('items_id', 'items_fk_9986974')->references('id')->on('orders');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_9986972')->references('id')->on('teams');
        });
    }
}
