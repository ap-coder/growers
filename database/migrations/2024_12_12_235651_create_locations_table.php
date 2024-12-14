<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->string('nickname')->nullable();
            $table->text('address'); // Changed to text
            $table->text('address_2')->nullable(); // Changed to text
            $table->string('city');
            $table->string('state');
            $table->string('zipcode');
            $table->string('phone')->nullable();
            $table->string('phone_2')->nullable();
            $table->text('full_address')->nullable(); // Changed to text
            $table->string('slug')->unique();
            $table->string('country');
            $table->string('google_map_url')->nullable();
            $table->boolean('published')->default(1);
            $table->timestamps();
            $table->softDeletes();

            // Adding indexes for performance improvements (optional)
            $table->index('client_id');
            $table->index('slug');
        });
    }

    public function down()
    {
        Schema::dropIfExists('locations');
    }
};
