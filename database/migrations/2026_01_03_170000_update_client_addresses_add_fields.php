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
        if (Schema::hasTable('client_addresses')) {
            Schema::table('client_addresses', function (Blueprint $table) {
                if (!Schema::hasColumn('client_addresses', 'nickname')) {
                    $table->string('nickname')->nullable()->after('label');
                }
                if (!Schema::hasColumn('client_addresses', 'google_map_link')) {
                    $table->string('google_map_link')->nullable()->after('special_instructions');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client_addresses', function (Blueprint $table) {
            $table->dropColumn(['nickname', 'google_map_link']);
        });
    }
};
