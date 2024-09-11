<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('clients_prices_id')->nullable();
            $table->foreign('clients_prices_id', 'clients_prices_fk_10112001')->references('id')->on('client_prices');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_9986809')->references('id')->on('teams');
        });
    }
}
