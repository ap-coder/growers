<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('faq_categories', function (Blueprint $table) {
            $table->boolean('is_fake')->default(false)->after('category');
        });
        
        Schema::table('faq_questions', function (Blueprint $table) {
            $table->boolean('is_fake')->default(false)->after('answer');
        });
        
        Schema::table('content_pages', function (Blueprint $table) {
            $table->boolean('is_fake')->default(false)->after('published');
        });
    }

    public function down(): void
    {
        Schema::table('faq_categories', function (Blueprint $table) {
            $table->dropColumn('is_fake');
        });
        
        Schema::table('faq_questions', function (Blueprint $table) {
            $table->dropColumn('is_fake');
        });
        
        Schema::table('content_pages', function (Blueprint $table) {
            $table->dropColumn('is_fake');
        });
    }
};
