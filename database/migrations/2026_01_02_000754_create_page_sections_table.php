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
        Schema::create('page_sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('content_page_id');
            $table->string('section_type'); // hero, text, text_image, image_text, gallery, cta, features, testimonials, faq, products, categories, contact, map, video, spacer
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->text('content')->nullable(); // Main text content or JSON for complex sections
            $table->string('button_text')->nullable();
            $table->string('button_url')->nullable();
            $table->string('button_style')->default('primary'); // primary, secondary, outline
            $table->string('background_color')->nullable();
            $table->string('background_image')->nullable();
            $table->string('text_color')->nullable();
            $table->string('alignment')->default('left'); // left, center, right
            $table->string('container_width')->default('container'); // container, container-fluid, full
            $table->string('padding')->default('normal'); // none, small, normal, large
            $table->json('settings')->nullable(); // Additional section-specific settings
            $table->integer('sort_order')->default(0);
            $table->boolean('published')->default(true);
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('content_page_id')->references('id')->on('content_pages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_sections');
    }
};
