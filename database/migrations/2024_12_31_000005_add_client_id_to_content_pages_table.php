<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('content_pages', function (Blueprint $table) {
            $table->unsignedBigInteger('client_id')->nullable()->after('id');
            $table->string('slug')->nullable()->after('title');
            $table->string('page_type')->default('general')->after('slug'); // general, how_to_order, etc.
            
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('set null');
            $table->index(['client_id', 'page_type']);
        });
    }

    public function down()
    {
        Schema::table('content_pages', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->dropIndex(['client_id', 'page_type']);
            $table->dropColumn(['client_id', 'slug', 'page_type']);
        });
    }
};
