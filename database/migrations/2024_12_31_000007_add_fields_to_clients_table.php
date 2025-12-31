<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('store_number')->nullable()->after('name');
            $table->string('contact_name')->nullable()->after('store_number');
            $table->string('contact_phone')->nullable()->after('contact_name');
            $table->string('contact_email')->nullable()->after('contact_phone');
            $table->text('address')->nullable()->after('contact_email');
            $table->text('delivery_notes')->nullable()->after('address');
            $table->boolean('requires_upc')->default(false)->after('delivery_notes');
        });
    }

    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn([
                'store_number',
                'contact_name', 
                'contact_phone',
                'contact_email',
                'address',
                'delivery_notes',
                'requires_upc'
            ]);
        });
    }
};
