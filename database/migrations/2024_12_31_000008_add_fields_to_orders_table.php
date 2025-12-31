<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->date('delivery_date')->nullable()->after('status');
            $table->text('special_request')->nullable()->after('delivery_date');
            $table->text('delivery_details')->nullable()->after('special_request');
            $table->string('ordered_by_name')->nullable()->after('delivery_details');
            $table->string('ordered_by_phone')->nullable()->after('ordered_by_name');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'delivery_date',
                'special_request',
                'delivery_details',
                'ordered_by_name',
                'ordered_by_phone'
            ]);
        });
    }
};
