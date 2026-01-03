<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        // Add slug to products
        Schema::table('products', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('name')->index();
        });

        // Add slug to product_categories
        Schema::table('product_categories', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('name')->index();
        });

        // Add slug to product_tags
        Schema::table('product_tags', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('name')->index();
        });

        // Generate slugs for existing records
        DB::table('products')->whereNull('slug')->orderBy('id')->chunk(100, function ($products) {
            foreach ($products as $product) {
                $slug = Str::slug($product->name);
                $originalSlug = $slug;
                $counter = 1;
                
                // Ensure unique slug
                while (DB::table('products')->where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                    $slug = $originalSlug . '-' . $counter;
                    $counter++;
                }
                
                DB::table('products')->where('id', $product->id)->update(['slug' => $slug]);
            }
        });

        DB::table('product_categories')->whereNull('slug')->orderBy('id')->chunk(100, function ($categories) {
            foreach ($categories as $category) {
                $slug = Str::slug($category->name);
                $originalSlug = $slug;
                $counter = 1;
                
                while (DB::table('product_categories')->where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
                    $slug = $originalSlug . '-' . $counter;
                    $counter++;
                }
                
                DB::table('product_categories')->where('id', $category->id)->update(['slug' => $slug]);
            }
        });

        DB::table('product_tags')->whereNull('slug')->orderBy('id')->chunk(100, function ($tags) {
            foreach ($tags as $tag) {
                $slug = Str::slug($tag->name);
                $originalSlug = $slug;
                $counter = 1;
                
                while (DB::table('product_tags')->where('slug', $slug)->where('id', '!=', $tag->id)->exists()) {
                    $slug = $originalSlug . '-' . $counter;
                    $counter++;
                }
                
                DB::table('product_tags')->where('id', $tag->id)->update(['slug' => $slug]);
            }
        });

        // Make slugs required after populating
        Schema::table('products', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->change();
        });

        Schema::table('product_categories', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->change();
        });

        Schema::table('product_tags', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('product_categories', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('product_tags', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
