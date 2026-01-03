<?php

namespace Database\Seeders;

use App\Models\Accessory;
use App\Models\AccessoryType;
use Illuminate\Database\Seeder;

class AccessorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accessoryTypes = [
            'Card Holders' => AccessoryType::firstOrCreate(['name' => 'Card Holders'], ['published' => true, 'sort_order' => 1]),
            'Ribbons' => AccessoryType::firstOrCreate(['name' => 'Ribbons'], ['published' => true, 'sort_order' => 2]),
            'Picks' => AccessoryType::firstOrCreate(['name' => 'Picks'], ['published' => true, 'sort_order' => 3]),
            'Bows' => AccessoryType::firstOrCreate(['name' => 'Bows'], ['published' => true, 'sort_order' => 4]),
        ];

        $accessoryNames = [
            'Card Holders' => ['Standard Card Holder', 'Premium Card Holder', 'Decorative Card Holder'],
            'Ribbons' => ['Satin Ribbon - Red', 'Satin Ribbon - White', 'Satin Ribbon - Gold', 'Organza Ribbon'],
            'Picks' => ['Happy Birthday Pick', 'Congratulations Pick', 'Thank You Pick', 'Get Well Pick'],
            'Bows' => ['Small Bow', 'Medium Bow', 'Large Bow', 'Deluxe Bow'],
        ];

        foreach ($accessoryNames as $typeName => $names) {
            $sortOrder = 1;
            foreach ($names as $name) {
                Accessory::firstOrCreate(
                    ['name' => $name],
                    [
                        'accessory_type_id' => $accessoryTypes[$typeName]->id,
                        'base_price' => rand(199, 999) / 100,
                        'sku' => 'ACC-' . strtoupper(substr(md5($name), 0, 6)),
                        'published' => true,
                        'sort_order' => $sortOrder++,
                    ]
                );
            }
        }
    }
}
