<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductCollectionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_collections')->delete();
        
        \DB::table('product_collections')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Grid Collection',
                'slug' => 'grid-collection',
                'description' => 'Demo collection showcasing the Grid layout.',
                'layout_type' => 'grid',
                'published' => 1,
                'show_on_homepage' => 1,
                'sort_order' => 1,
                'background_color' => NULL,
                'text_color' => NULL,
                'columns' => 4,
                'is_fake' => 1,
                'created_at' => '2026-01-03 06:01:37',
                'updated_at' => '2026-01-03 06:01:37',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Masonry Grid Collection',
                'slug' => 'masonry-grid-collection',
                'description' => 'Demo collection showcasing the Masonry Grid layout.',
                'layout_type' => 'masonry',
                'published' => 1,
                'show_on_homepage' => 1,
                'sort_order' => 2,
                'background_color' => NULL,
                'text_color' => NULL,
                'columns' => 4,
                'is_fake' => 1,
                'created_at' => '2026-01-03 06:01:37',
                'updated_at' => '2026-01-03 06:01:37',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Carousel Showcase Collection',
                'slug' => 'carousel-showcase-collection',
                'description' => 'Demo collection showcasing the Carousel Showcase layout.',
                'layout_type' => 'carousel',
                'published' => 1,
                'show_on_homepage' => 1,
                'sort_order' => 3,
                'background_color' => NULL,
                'text_color' => NULL,
                'columns' => 3,
                'is_fake' => 1,
                'created_at' => '2026-01-03 06:01:37',
                'updated_at' => '2026-01-03 06:01:37',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Tiles Collection',
                'slug' => 'tiles-collection',
                'description' => 'Demo collection showcasing the Tiles layout.',
                'layout_type' => 'tiles',
                'published' => 1,
                'show_on_homepage' => 0,
                'sort_order' => 4,
                'background_color' => NULL,
                'text_color' => NULL,
                'columns' => 3,
                'is_fake' => 1,
                'created_at' => '2026-01-03 06:01:37',
                'updated_at' => '2026-01-03 06:01:37',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Cobble Style 1 Collection',
                'slug' => 'cobble-style-1-collection',
                'description' => 'Demo collection showcasing the Cobble Style 1 layout.',
                'layout_type' => 'cobble-1',
                'published' => 1,
                'show_on_homepage' => 0,
                'sort_order' => 5,
                'background_color' => NULL,
                'text_color' => NULL,
                'columns' => 3,
                'is_fake' => 1,
                'created_at' => '2026-01-03 06:01:37',
                'updated_at' => '2026-01-03 06:01:37',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Cobble Style 2 Collection',
                'slug' => 'cobble-style-2-collection',
                'description' => 'Demo collection showcasing the Cobble Style 2 layout.',
                'layout_type' => 'cobble-2',
                'published' => 1,
                'show_on_homepage' => 0,
                'sort_order' => 6,
                'background_color' => NULL,
                'text_color' => NULL,
                'columns' => 3,
                'is_fake' => 1,
                'created_at' => '2026-01-03 06:01:37',
                'updated_at' => '2026-01-03 06:01:37',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Collage Style 1 Collection',
                'slug' => 'collage-style-1-collection',
                'description' => 'Demo collection showcasing the Collage Style 1 layout.',
                'layout_type' => 'collage-1',
                'published' => 1,
                'show_on_homepage' => 0,
                'sort_order' => 7,
                'background_color' => NULL,
                'text_color' => NULL,
                'columns' => 3,
                'is_fake' => 1,
                'created_at' => '2026-01-03 06:01:37',
                'updated_at' => '2026-01-03 06:01:37',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Collage Style 2 Collection',
                'slug' => 'collage-style-2-collection',
                'description' => 'Demo collection showcasing the Collage Style 2 layout.',
                'layout_type' => 'collage-2',
                'published' => 1,
                'show_on_homepage' => 0,
                'sort_order' => 8,
                'background_color' => NULL,
                'text_color' => NULL,
                'columns' => 3,
                'is_fake' => 1,
                'created_at' => '2026-01-03 06:01:37',
                'updated_at' => '2026-01-03 06:01:37',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Film Strip Collection',
                'slug' => 'film-strip-collection',
                'description' => 'Demo collection showcasing the Film Strip layout.',
                'layout_type' => 'film-strip',
                'published' => 1,
                'show_on_homepage' => 0,
                'sort_order' => 9,
                'background_color' => NULL,
                'text_color' => NULL,
                'columns' => 3,
                'is_fake' => 1,
                'created_at' => '2026-01-03 06:01:37',
                'updated_at' => '2026-01-03 06:01:37',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Split Slider Collection',
                'slug' => 'split-slider-collection',
                'description' => 'Demo collection showcasing the Split Slider layout.',
                'layout_type' => 'split-slider',
                'published' => 1,
                'show_on_homepage' => 0,
                'sort_order' => 10,
                'background_color' => NULL,
                'text_color' => NULL,
                'columns' => 3,
                'is_fake' => 1,
                'created_at' => '2026-01-03 06:01:37',
                'updated_at' => '2026-01-03 06:01:37',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Thumbs Slider Collection',
                'slug' => 'thumbs-slider-collection',
                'description' => 'Demo collection showcasing the Thumbs Slider layout.',
                'layout_type' => 'thumbs-slider',
                'published' => 1,
                'show_on_homepage' => 0,
                'sort_order' => 11,
                'background_color' => NULL,
                'text_color' => NULL,
                'columns' => 3,
                'is_fake' => 1,
                'created_at' => '2026-01-03 06:01:37',
                'updated_at' => '2026-01-03 06:01:37',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}