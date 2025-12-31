<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            if (!Schema::hasColumn('settings', 'type')) {
                $table->string('type')->default('text')->after('value');
            }
            if (!Schema::hasColumn('settings', 'group')) {
                $table->string('group')->default('general')->after('type');
            }
            if (!Schema::hasColumn('settings', 'label')) {
                $table->string('label')->nullable()->after('group');
            }
            if (!Schema::hasColumn('settings', 'description')) {
                $table->text('description')->nullable()->after('label');
            }
        });
    }

    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['type', 'group', 'label', 'description']);
        });
    }
};
