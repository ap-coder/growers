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
        Schema::create('reminders', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('message')->nullable();
            $table->string('type')->default('info'); // info, warning, error, success
            $table->string('link')->nullable(); // URL to edit page
            $table->string('link_text')->nullable(); // Button text
            $table->string('model_type')->nullable(); // e.g., App\Models\Page
            $table->unsignedBigInteger('model_id')->nullable(); // e.g., page ID
            $table->boolean('dismissed')->default(false);
            $table->unsignedBigInteger('dismissed_by')->nullable();
            $table->timestamp('dismissed_at')->nullable();
            $table->timestamps();
            
            $table->index(['model_type', 'model_id']);
            $table->index('dismissed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reminders');
    }
};
