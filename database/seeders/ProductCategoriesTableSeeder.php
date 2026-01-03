<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductCategoriesTableSeeder extends Seeder
{

    public function run()
    {
        \DB::table('product_categories')->delete();
    }
}
