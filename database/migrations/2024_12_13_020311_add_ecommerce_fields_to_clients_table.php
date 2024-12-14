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
        Schema::table('clients', function (Blueprint $table) {

            $table->string('company_name')->nullable()->after('name'); // Optional company name
            $table->string('email')->nullable()->after('company_name'); // Optional email
            $table->string('phone')->nullable()->after('email'); // Optional phone
            $table->boolean('is_verified')->default(false)->after('phone'); // Optional verification status
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn([
                'company_name',
                'email',
                'phone',
                'is_verified',
            ]);
        });
    }
};
