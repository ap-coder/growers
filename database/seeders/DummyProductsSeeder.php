<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductTag;
use App\Models\Client;
use App\Models\ClientPrice;
use App\Models\AccessoryType;
use App\Models\ProductBundleItem;
use Illuminate\Database\Seeder;

class DummyProductsSeeder extends Seeder
{
    public function run(): void
    {
        // Create categories if they don't exist
        $categories = [
            'Baskets' => ProductCategory::firstOrCreate(['name' => 'Baskets']),
            'Ceramics' => ProductCategory::firstOrCreate(['name' => 'Ceramics']),
            'Foliage' => ProductCategory::firstOrCreate(['name' => 'Foliage']),
            'Tins' => ProductCategory::firstOrCreate(['name' => 'Tins']),
            'Wood' => ProductCategory::firstOrCreate(['name' => 'Wood']),
            'Bamboo' => ProductCategory::firstOrCreate(['name' => 'Bamboo']),
            'Novelty' => ProductCategory::firstOrCreate(['name' => 'Novelty']),
            'Supplies' => ProductCategory::firstOrCreate(['name' => 'Supplies']),
            'Specialty' => ProductCategory::firstOrCreate(['name' => 'Specialty']),
        ];

        // Create tags
        $tags = [
            'Seasonal' => ProductTag::firstOrCreate(['name' => 'Seasonal']),
            'Valentines' => ProductTag::firstOrCreate(['name' => 'Valentines']),
            'Spring' => ProductTag::firstOrCreate(['name' => 'Spring']),
            'Summer' => ProductTag::firstOrCreate(['name' => 'Summer']),
            'Fall' => ProductTag::firstOrCreate(['name' => 'Fall']),
            'Christmas' => ProductTag::firstOrCreate(['name' => 'Christmas']),
            'Mothers Day' => ProductTag::firstOrCreate(['name' => 'Mothers Day']),
        ];

        // Create accessory types
        $accessoryTypes = [
            'Card Holders' => AccessoryType::firstOrCreate(['name' => 'Card Holders']),
            'Ribbons' => AccessoryType::firstOrCreate(['name' => 'Ribbons']),
            'Picks' => AccessoryType::firstOrCreate(['name' => 'Picks']),
            'Bows' => AccessoryType::firstOrCreate(['name' => 'Bows']),
        ];

        // Get first client for client pricing examples
        $client = Client::first();

        // Standard Products
        $standardProducts = [
            [
                'name' => '6" Red Heart Basket',
                'description' => 'Beautiful red heart-shaped basket, perfect for Valentine\'s Day arrangements.',
                'product_type' => 'standard',
                'base_price' => 12.50,
                'sku' => 'BKT-RH-6',
                'upc_code' => '123456789012',
                'qb_1' => 'QB-BKT-001',
                'qb_2' => 'INV-BKT-001',
                'quantity' => 150,
                'published' => true,
                'featured' => true,
                'category' => 'Baskets',
                'tags' => ['Valentines', 'Seasonal'],
            ],
            [
                'name' => '8" White Round Basket',
                'description' => 'Classic white round basket for everyday arrangements.',
                'product_type' => 'standard',
                'base_price' => 15.00,
                'sku' => 'BKT-WR-8',
                'upc_code' => '123456789013',
                'qb_1' => 'QB-BKT-002',
                'qb_2' => 'INV-BKT-002',
                'quantity' => 200,
                'published' => true,
                'featured' => false,
                'category' => 'Baskets',
                'tags' => ['Spring'],
            ],
            [
                'name' => '4" Ceramic Pot - Blue',
                'description' => 'Small blue ceramic pot, great for succulents.',
                'product_type' => 'standard',
                'base_price' => 8.00,
                'sku' => 'CER-BL-4',
                'upc_code' => '123456789014',
                'qb_1' => 'QB-CER-001',
                'qb_2' => null,
                'quantity' => 300,
                'published' => true,
                'featured' => false,
                'category' => 'Ceramics',
                'tags' => [],
            ],
            [
                'name' => '6" Ceramic Pot - White',
                'description' => 'Medium white ceramic pot with drainage hole.',
                'product_type' => 'standard',
                'base_price' => 10.50,
                'sku' => 'CER-WH-6',
                'upc_code' => '123456789015',
                'qb_1' => 'QB-CER-002',
                'qb_2' => null,
                'quantity' => 250,
                'published' => true,
                'featured' => true,
                'category' => 'Ceramics',
                'tags' => [],
            ],
            [
                'name' => 'Bamboo Planter Box - Small',
                'description' => 'Eco-friendly bamboo planter box, 8x4 inches.',
                'product_type' => 'standard',
                'base_price' => 14.00,
                'sku' => 'BMB-PB-SM',
                'upc_code' => '123456789016',
                'qb_1' => 'QB-BMB-001',
                'qb_2' => null,
                'quantity' => 100,
                'published' => true,
                'featured' => false,
                'category' => 'Bamboo',
                'tags' => ['Spring', 'Summer'],
            ],
            [
                'name' => 'Rustic Wood Crate',
                'description' => 'Distressed wood crate for rustic arrangements.',
                'product_type' => 'standard',
                'base_price' => 18.00,
                'sku' => 'WD-CRT-01',
                'upc_code' => '123456789017',
                'qb_1' => 'QB-WD-001',
                'qb_2' => null,
                'quantity' => 75,
                'published' => true,
                'featured' => false,
                'category' => 'Wood',
                'tags' => ['Fall'],
            ],
            [
                'name' => 'Decorative Tin Bucket - Red',
                'description' => 'Small red tin bucket with handle.',
                'product_type' => 'standard',
                'base_price' => 6.50,
                'sku' => 'TIN-RD-SM',
                'upc_code' => '123456789018',
                'qb_1' => 'QB-TIN-001',
                'qb_2' => null,
                'quantity' => 400,
                'published' => true,
                'featured' => false,
                'category' => 'Tins',
                'tags' => ['Christmas', 'Valentines'],
            ],
            [
                'name' => 'Peace Lily - 6"',
                'description' => 'Beautiful peace lily in 6" pot.',
                'product_type' => 'standard',
                'base_price' => 22.00,
                'sku' => 'PLT-PL-6',
                'upc_code' => '123456789019',
                'qb_1' => 'QB-PLT-001',
                'qb_2' => null,
                'quantity' => 50,
                'published' => true,
                'featured' => true,
                'category' => 'Foliage',
                'tags' => ['Mothers Day'],
            ],
        ];

        // Accessory Products
        $accessoryProducts = [
            [
                'name' => 'Gold Card Holder - Heart',
                'description' => 'Gold heart-shaped card holder pick.',
                'product_type' => 'accessory',
                'accessory_type' => 'Card Holders',
                'base_price' => 1.25,
                'sku' => 'ACC-CH-GH',
                'upc_code' => '223456789001',
                'qb_1' => 'QB-ACC-001',
                'qb_2' => null,
                'quantity' => 500,
                'published' => true,
            ],
            [
                'name' => 'Silver Card Holder - Round',
                'description' => 'Silver round card holder pick.',
                'product_type' => 'accessory',
                'accessory_type' => 'Card Holders',
                'base_price' => 1.25,
                'sku' => 'ACC-CH-SR',
                'upc_code' => '223456789002',
                'qb_1' => 'QB-ACC-002',
                'qb_2' => null,
                'quantity' => 500,
                'published' => true,
            ],
            [
                'name' => 'Red Satin Ribbon - 1"',
                'description' => '1 inch red satin ribbon, per yard.',
                'product_type' => 'accessory',
                'accessory_type' => 'Ribbons',
                'base_price' => 0.75,
                'sku' => 'ACC-RB-RS1',
                'upc_code' => '223456789003',
                'qb_1' => 'QB-ACC-003',
                'qb_2' => null,
                'quantity' => 1000,
                'published' => true,
            ],
            [
                'name' => 'White Organza Bow',
                'description' => 'Pre-made white organza bow.',
                'product_type' => 'accessory',
                'accessory_type' => 'Bows',
                'base_price' => 2.00,
                'sku' => 'ACC-BW-WO',
                'upc_code' => '223456789004',
                'qb_1' => 'QB-ACC-004',
                'qb_2' => null,
                'quantity' => 300,
                'published' => true,
            ],
            [
                'name' => 'Butterfly Pick - Assorted',
                'description' => 'Decorative butterfly pick, assorted colors.',
                'product_type' => 'accessory',
                'accessory_type' => 'Picks',
                'base_price' => 1.50,
                'sku' => 'ACC-PK-BF',
                'upc_code' => '223456789005',
                'qb_1' => 'QB-ACC-005',
                'qb_2' => null,
                'quantity' => 400,
                'published' => true,
            ],
        ];

        // Create standard products
        $createdProducts = [];
        foreach ($standardProducts as $productData) {
            $category = $productData['category'];
            $productTags = $productData['tags'];
            unset($productData['category'], $productData['tags']);

            $product = Product::create($productData);
            $product->categories()->attach($categories[$category]->id);
            
            if (!empty($productTags)) {
                $tagIds = collect($productTags)->map(fn($t) => $tags[$t]->id)->toArray();
                $product->tags()->attach($tagIds);
            }

            // Add client-specific pricing for first client
            if ($client) {
                ClientPrice::create([
                    'product_id' => $product->id,
                    'client_id' => $client->id,
                    'price' => $productData['base_price'] * 0.9, // 10% discount for client
                ]);
            }

            $createdProducts[$product->name] = $product;
        }

        // Create accessory products
        foreach ($accessoryProducts as $productData) {
            $accessoryTypeName = $productData['accessory_type'];
            unset($productData['accessory_type']);
            
            $productData['accessory_type_id'] = $accessoryTypes[$accessoryTypeName]->id;
            
            $product = Product::create($productData);
            $createdProducts[$product->name] = $product;
        }

        // Create a Set/Bundle product
        $valentineSet = Product::create([
            'name' => 'Valentine\'s Day Basket Set',
            'description' => 'Complete Valentine\'s Day arrangement set. Includes basket, card holder, and ribbon.',
            'product_type' => 'set',
            'base_price' => 25.00,
            'sku' => 'SET-VAL-01',
            'upc_code' => '323456789001',
            'qb_1' => 'QB-SET-001',
            'qb_2' => null,
            'quantity' => 0,
            'published' => true,
            'featured' => true,
        ]);
        $valentineSet->categories()->attach($categories['Baskets']->id);
        $valentineSet->tags()->attach([$tags['Valentines']->id, $tags['Seasonal']->id]);

        // Add bundle items
        if (isset($createdProducts['6" Red Heart Basket'])) {
            ProductBundleItem::create([
                'bundle_product_id' => $valentineSet->id,
                'item_product_id' => $createdProducts['6" Red Heart Basket']->id,
                'quantity' => 1,
                'is_required' => true,
                'is_selectable' => false,
                'group_name' => 'Basket',
                'sort_order' => 1,
            ]);
        }
        if (isset($createdProducts['Gold Card Holder - Heart'])) {
            ProductBundleItem::create([
                'bundle_product_id' => $valentineSet->id,
                'item_product_id' => $createdProducts['Gold Card Holder - Heart']->id,
                'quantity' => 1,
                'is_required' => true,
                'is_selectable' => true,
                'group_name' => 'Card Holder',
                'sort_order' => 2,
            ]);
        }
        if (isset($createdProducts['Silver Card Holder - Round'])) {
            ProductBundleItem::create([
                'bundle_product_id' => $valentineSet->id,
                'item_product_id' => $createdProducts['Silver Card Holder - Round']->id,
                'quantity' => 1,
                'is_required' => false,
                'is_selectable' => true,
                'group_name' => 'Card Holder',
                'sort_order' => 3,
            ]);
        }
        if (isset($createdProducts['Red Satin Ribbon - 1"'])) {
            ProductBundleItem::create([
                'bundle_product_id' => $valentineSet->id,
                'item_product_id' => $createdProducts['Red Satin Ribbon - 1"']->id,
                'quantity' => 2,
                'is_required' => false,
                'is_selectable' => true,
                'group_name' => 'Accessories',
                'sort_order' => 4,
            ]);
        }

        $this->command->info('Dummy products created successfully!');
        $this->command->info('Created: ' . count($standardProducts) . ' standard products');
        $this->command->info('Created: ' . count($accessoryProducts) . ' accessories');
        $this->command->info('Created: 1 bundle/set');
    }

    /**
     * Remove all dummy products (those with SKU starting with test prefixes)
     */
    public static function removeDummyProducts(): int
    {
        $skuPrefixes = ['BKT-', 'CER-', 'BMB-', 'WD-', 'TIN-', 'PLT-', 'ACC-', 'SET-'];
        
        $count = 0;
        foreach ($skuPrefixes as $prefix) {
            $products = Product::where('sku', 'like', $prefix . '%')->get();
            foreach ($products as $product) {
                // Delete related records
                $product->categories()->detach();
                $product->tags()->detach();
                $product->clientPrices()->delete();
                ProductBundleItem::where('bundle_product_id', $product->id)->delete();
                ProductBundleItem::where('item_product_id', $product->id)->delete();
                $product->forceDelete();
                $count++;
            }
        }
        
        return $count;
    }
}
