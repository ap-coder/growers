<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductIdToClientPricesTabletwo extends Migration
{
    public function up()
    {
        Schema::table('client_prices', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->nullable()->after('team_id');
            $table->foreign('product_id', 'product_fk_10501234')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('client_prices', function (Blueprint $table) {
            $table->dropForeign('product_fk_10501234');
            $table->dropColumn('product_id');
        });
    }
}
