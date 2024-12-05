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
        Schema::table('client_prices', function (Blueprint $table) {
            // Make product_id and client_id non-nullable
            $table->unsignedBigInteger('product_id')->change();
            $table->unsignedBigInteger('client_id')->change();
        });
    }

};
