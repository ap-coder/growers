<?php

namespace Database\Seeders;

use App\Models\VariationCategory;
use Illuminate\Database\Seeder;

class VariationCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Size', 'slug' => 'size', 'description' => 'Size variations (Small, Medium, Large, etc.)', 'sort_order' => 1],
            ['name' => 'Color', 'slug' => 'color', 'description' => 'Color variations (Red, Blue, Green, etc.)', 'sort_order' => 2],
            ['name' => 'Material', 'slug' => 'material', 'description' => 'Material variations (Plastic, Ceramic, Terra Cotta, etc.)', 'sort_order' => 3],
            ['name' => 'Style', 'slug' => 'style', 'description' => 'Style variations (Modern, Classic, Rustic, etc.)', 'sort_order' => 4],
        ];

        foreach ($categories as $category) {
            VariationCategory::firstOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
