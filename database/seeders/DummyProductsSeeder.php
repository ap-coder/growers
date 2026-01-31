<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductTag;
use App\Models\ProductVariation;
use App\Models\Client;
use App\Models\ClientPrice;
use App\Models\AccessoryType;
use App\Models\Accessory;
use App\Models\ProductBundleItem;
use App\Models\ProductPriceTier;
use App\Models\VariationCategory;
use App\Models\FaqCategory;
use App\Models\FaqQuestion;
use App\Models\ContentPage;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DummyProductsSeeder extends Seeder
{
    private static function generateDemoContent(Product $product): void
    {
        $productName = $product->name;

        $description = '<div class="row  g-3 m-b30 align-items-center">' .
            '<div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 ">' .
                '<div class="description style-1">' .
                    '<h2 class="sub-title">The Quality &amp; Style</h2>' .
                    '<h2 class="title">Premium Quality Indoor Plants</h2>' .
                    '<p class="font-wight-500">Pacific Plant Growers has been supplying premium indoor plants to grocery stores and flower shops for over 20 years. Our ' . $productName . ' is carefully grown and nurtured to ensure it arrives in peak condition, ready to delight your customers with its vibrant foliage and healthy appearance.</p>' .
                '</div>' .
            '</div>' .
            '<div class="col-xl-4 col-lg-3 col-md-6 col-sm-6 ">' .
                '<div class="related-img dz-media">' .
                    '<img src="/site/images/feature/product-feature-4/1.png" alt="/">' .
                '</div>' .
            '</div>' .
            '<div class="col-xl-4 col-lg-3 col-md-6 col-sm-6">' .
                '<div class="related-img dz-media">' .
                    '<img src="/site/images/feature/product-feature-4/2.png" alt="/">' .
                '</div>' .
            '</div>' .
        '</div>' .
        '<div class="row g-lg-4 g-3">' .
            '<div class="col-xl-3 col-md-6 col-sm-12 ">' .
                '<div class="icon-bx-wraper style-6 m-b15">' .
                    '<div class="icon-bx">' .
                        '<i class="flaticon flaticon-chat-8"></i>' .
                    '</div>' .
                    '<div class="icon-content">' .
                        '<h3 class="dz-title">Eco Friendly Product</h3>' .
                    '</div>' .
                '</div>' .
            '</div>' .
            '<div class="col-xl-3 col-md-6 col-sm-12 ">' .
                '<div class="icon-bx-wraper style-6 m-b15">' .
                    '<div class="icon-bx">' .
                        '<i class="flaticon flaticon-paper"></i>' .
                    '</div>' .
                    '<div class="icon-content">' .
                        '<h3 class="dz-title">Easy To Clean And Maintain</h3>' .
                    '</div>' .
                '</div>' .
            '</div>' .
            '<div class="col-xl-3 col-md-6 col-sm-12">' .
                '<div class="icon-bx-wraper style-6 m-b15">' .
                    '<div class="icon-bx">' .
                        '<i class="flaticon flaticon-cardboard-box"></i>' .
                    '</div>' .
                    '<div class="icon-content">' .
                        '<h3 class="dz-title">Premium Finish Quality</h3>' .
                    '</div>' .
                '</div>' .
            '</div>' .
            '<div class="col-xl-3 col-md-6 col-sm-12">' .
                '<div class="icon-bx-wraper style-6 m-b15 border-0">' .
                    '<div class="icon-bx">' .
                        '<i class="flaticon flaticon-delivery-status"></i>' .
                    '</div>' .
                    '<div class="icon-content">' .
                        '<h3 class="dz-title">Moisture Proof Product</h3>' .
                    '</div>' .
                '</div>' .
            '</div>' .
        '</div>' .
        '<img src="/site/images/background/bg4.jpg" alt="">';

        $additionalInfo = '<div class="detail-bx text-center">' .
            '<h5 class="title">Additional Information</h5>' .
            '<p class="para-text">' .
                'Pacific Plant Growers has been supplying premium indoor plants to retailers for over 20 years. Our ' . $productName . ' represents our commitment to quality, freshness, and customer satisfaction. Each plant is carefully grown and nurtured in our greenhouses to ensure it arrives in peak condition, ready to delight your customers. We specialize in providing healthy, vibrant plants that are perfect for grocery stores, flower shops, and garden centers throughout the region.' .
            '</p>' .
            '<ul class="feature-detail justify-content-center">' .
                '<li>' .
                    '<i class="icon feather icon-check"></i>' .
                    '<h5>Technical Details</h5>' .
                '</li>' .
                '<li>' .
                    '<i class="icon feather icon-check"></i>' .
                    '<h5>Additional Information</h5>' .
                '</li>' .
                '<li>' .
                    '<i class="icon feather icon-check"></i>' .
                    '<h5> Feedback </h5>' .
                '</li>' .
            '</ul>' .
        '</div>' .
        '<div class="table-responsive">' .
            '<table class="table check-tbl">' .
                '<tbody>' .
                    '<tr>' .
                        '<td class="product-item-name">Product ID</td>' .
                        '<td class="product-item-name">PPG-' . strtoupper(str_replace(' ', '-', $productName)) . '</td>' .
                    '</tr>' .
                    '<tr>' .
                        '<td class="product-item-name">Grower</td>' .
                        '<td class="product-item-name">Pacific Plant Growers</td>' .
                    '</tr>' .
                    '<tr>' .
                        '<td class="product-item-name">Origin</td>' .
                        '<td class="product-item-name">United States</td>' .
                    '</tr>' .
                    '<tr>' .
                        '<td class="product-item-name">Growing Method</td>' .
                        '<td class="product-item-name">Greenhouse Grown</td>' .
                    '</tr>' .
                    '<tr>' .
                        '<td class="product-item-name">Pot Size</td>' .
                        '<td class="product-item-name">4 inch / 6 inch / 8 inch</td>' .
                    '</tr>' .
                    '<tr>' .
                        '<td class="product-item-name">Care Level</td>' .
                        '<td class="product-item-name">Easy to Moderate</td>' .
                    '</tr>' .
                    '<tr>' .
                        '<td class="product-item-name">Light Requirements</td>' .
                        '<td class="product-item-name">Bright Indirect Light</td>' .
                    '</tr>' .
                    '<tr>' .
                        '<td class="product-item-name">Category</td>' .
                        '<td class="product-item-name">Indoor Plant</td>' .
                    '</tr>' .
                '</tbody>' .
            '</table>' .
        '</div>';

        $shippingReturn = '<div class="detail-bx text-center">' .
            '<h5 class="title">Shipping Policy</h5>' .
            '<p class="para-text">' .
                'We deliver fresh, healthy plants directly to your store location. All plants are carefully packaged to ensure they arrive in excellent condition. Our delivery schedules are coordinated with your receiving department for maximum convenience. We understand the importance of timely delivery for perishable products, and our logistics team works diligently to ensure your ' . $productName . ' arrives ready for immediate display and sale to your customers.' .
            '</p>' .
            '<h5 class="title">Returns Policy</h5>' .
            '<p class="para-text">' .
                'We stand behind the quality of our plants. If you receive a plant that does not meet our quality standards, please contact us within 48 hours of delivery. We will work with you to resolve any issues promptly, whether through replacement or credit. Your satisfaction is our priority, and we are committed to ensuring every ' . $productName . ' you receive meets the high standards Pacific Plant Growers is known for throughout the industry.' .
            '</p>' .
            '<ul class="feature-detail justify-content-center">' .
                '<li>' .
                    '<i class="icon feather icon-check"></i>' .
                    '<h5>7 Days Replacement only</h5>' .
                '</li>' .
                '<li>' .
                    '<i class="icon feather icon-check"></i>' .
                    '<h5>7 Days Refund for accidental orders only</h5>' .
                '</li>' .
                '<li>' .
                    '<i class="icon feather icon-check"></i>' .
                    '<h5>3 days refund only</h5>' .
                '</li>' .
            '</ul>' .
        '</div>';

        $excerpts = [
            'Premium quality ' . $productName . ' perfect for retail display. Healthy, vibrant plants that your customers will love.',
            'Fresh, beautiful ' . $productName . ' from Pacific Plant Growers. Easy care and excellent for grocery stores and flower shops.',
            'Wholesale ' . $productName . ' with consistent quality and reliable delivery. Perfect addition to your plant department.',
            'Attractive ' . $productName . ' ideal for retail sales. Low maintenance and customer-friendly care requirements.'
        ];

        $randomExcerpt = $excerpts[array_rand($excerpts)];

        $product->update([
            'excerpt' => $randomExcerpt,
            'description' => $description,
            'additional_info' => $additionalInfo,
            'shipping_return' => $shippingReturn,
        ]);
    }

    private function downloadPlaceholderImage(string $type = 'plant', string $text = null): ?string
    {
        try {
            $width = 600;
            $height = 400;
            $text = $text ?? ucfirst($type);
            $url = "https://placehold.co/{$width}x{$height}/EEE/31343C?font=poppins&text=" . urlencode($text);

            $response = Http::timeout(15)->get($url);

            if ($response->successful()) {
                Storage::disk('public')->makeDirectory('products');
                $filename = "products/{$type}_" . uniqid() . '.png';
                Storage::disk('public')->put($filename, $response->body());
                return $filename;
            }
        } catch (\Exception $e) {
            if ($this->command) {
                $this->command->warn("  Could not download image: " . $e->getMessage());
            }
        }

        return null;
    }

    public function run(): void
    {
        $this->command->info('Creating dummy data using factories...');

        $result = self::seedDummyProducts();
        $this->command->info("  Created {$result['products']} products, {$result['variations']} variations");

        $this->command->info('Dummy products created successfully!');
    }

    private static function ensureCategoriesAndTags(): array
    {
        $categoryNames = [
            'Tropical Plants', 'Succulents', 'Foliage Plants', 'Flowering Plants', 'Outdoor Plants',
            'Baskets', 'Ceramics', 'Tins', 'Planters', 'Supplies'
        ];
        $categories = [];
        foreach ($categoryNames as $name) {
            $categories[$name] = ProductCategory::firstOrCreate(
                ['name' => $name],
                ['is_fake' => true, 'published' => true]
            );
        }

        $tagNames = ['Seasonal', 'Valentines', 'Spring', 'Summer', 'Fall', 'Christmas', 'Mothers Day', 'Easter', 'Best Seller'];
        $tags = [];
        foreach ($tagNames as $name) {
            $tags[$name] = ProductTag::firstOrCreate(
                ['name' => $name],
                ['is_fake' => true]
            );
        }

        return ['categories' => $categories, 'tags' => $tags];
    }

    private static function ensureSharedPriceTiers(): array
    {
        $tierGroup = 'Volume Discounts';

        $tiers = [
            [
                'name' => 'Regular',
                'min_quantity' => 1,
                'max_quantity' => 24,
                'discount_percent' => 0,
                'sort_order' => 1,
            ],
            [
                'name' => 'Bulk',
                'min_quantity' => 25,
                'max_quantity' => 49,
                'discount_percent' => 10,
                'sort_order' => 2,
            ],
            [
                'name' => 'Volume',
                'min_quantity' => 50,
                'max_quantity' => 99,
                'discount_percent' => 15,
                'sort_order' => 3,
            ],
            [
                'name' => 'Wholesale',
                'min_quantity' => 100,
                'max_quantity' => null,
                'discount_percent' => 20,
                'sort_order' => 4,
            ],
        ];

        return ['tier_group' => $tierGroup, 'tiers' => $tiers];
    }

    private static function ensureSharedVariations(): array
    {
        $variationSets = [
            'Size' => [
                'Small' => 'Compact size, perfect for small spaces',
                'Medium' => 'Standard size for most applications',
                'Large' => 'Generous size for maximum impact',
                'Extra Large' => 'Our largest option for statement pieces',
            ],
            'Pot Size' => [
                '4"' => '4 inch pot, ideal for windowsills',
                '6"' => '6 inch pot, great for desks and tables',
                '8"' => '8 inch pot, perfect floor accent',
                '10"' => '10 inch pot, impressive floor display',
            ],
            'Color' => [
                'Red' => 'Vibrant red variety',
                'Pink' => 'Soft pink coloring',
                'White' => 'Classic white variety',
                'Mixed' => 'Assorted color mix',
            ],
            'Grade' => [
                'Standard' => 'Quality standard grade',
                'Premium' => 'Hand-selected premium quality',
                'Select' => 'Top-tier select grade',
            ],
        ];

        $categories = [];
        foreach (array_keys($variationSets) as $categoryName) {
            $categories[$categoryName] = VariationCategory::firstOrCreate(
                ['name' => $categoryName],
                ['published' => true, 'is_fake' => true]
            );
        }

        return ['categories' => $categories, 'variations' => $variationSets];
    }

    private static function ensureAccessoryItems(): array
    {
        $accessoryTypes = [
            'Card Holders' => AccessoryType::firstOrCreate(['name' => 'Card Holders'], ['published' => true, 'sort_order' => 1, 'is_fake' => true]),
            'Ribbons' => AccessoryType::firstOrCreate(['name' => 'Ribbons'], ['published' => true, 'sort_order' => 2, 'is_fake' => true]),
            'Picks' => AccessoryType::firstOrCreate(['name' => 'Picks'], ['published' => true, 'sort_order' => 3, 'is_fake' => true]),
            'Bows' => AccessoryType::firstOrCreate(['name' => 'Bows'], ['published' => true, 'sort_order' => 4, 'is_fake' => true]),
        ];

        $accessoryItems = [];
        $accessoryNames = [
            'Card Holders' => ['Gold Card Holder', 'Silver Card Holder', 'Bronze Card Holder'],
            'Ribbons' => ['Red Satin Ribbon', 'Gold Ribbon', 'White Organza Ribbon', 'Green Velvet Ribbon'],
            'Picks' => ['Holiday Pick', 'Spring Pick', 'Birthday Pick'],
            'Bows' => ['Red Bow', 'Gold Bow', 'Silver Bow', 'White Bow'],
        ];
        foreach ($accessoryNames as $typeName => $names) {
            foreach ($names as $name) {
                $accessoryItems[] = Accessory::firstOrCreate(
                    ['name' => $name],
                    [
                        'accessory_type_id' => $accessoryTypes[$typeName]->id,
                        'base_price' => rand(199, 999) / 100,
                        'sku' => 'ACC-' . strtoupper(substr(md5($name), 0, 6)),
                        'published' => true,
                        'is_fake' => true,
                    ]
                );
            }
        }

        return ['types' => $accessoryTypes, 'items' => $accessoryItems];
    }

    public static function seedDummyProducts(int $count = 15): array
    {
        set_time_limit(120);

        $data = self::ensureCategoriesAndTags();
        $categories = $data['categories'];
        $tags = $data['tags'];
        $accessoryData = self::ensureAccessoryItems();
        $accessoryItems = $accessoryData['items'];

        $clients = Client::where('name', '!=', 'We Code Laravel')->get();

        $priceTierData = self::ensureSharedPriceTiers();
        $variationData = self::ensureSharedVariations();

        $products = Product::factory()->count($count)->create();
        $variationCount = 0;

        foreach ($products as $product) {
            $categoryArray = array_values($categories);
            $numCategories = rand(1, min(2, count($categoryArray)));
            $randomCategories = collect($categoryArray)->random($numCategories);
            $product->categories()->syncWithoutDetaching($randomCategories->pluck('id')->toArray());

            if ($clients->count() > 0) {
                $numClients = rand(1, min(3, $clients->count()));
                $randomClients = $clients->random($numClients);
                $product->clients()->syncWithoutDetaching($randomClients->pluck('id')->toArray());
            }

            $numTags = rand(0, 3);
            if ($numTags > 0) {
                $randomTags = array_rand($tags, min($numTags, count($tags)));
                if (!is_array($randomTags)) $randomTags = [$randomTags];
                $tagIds = array_map(fn($key) => $tags[$key]->id, $randomTags);
                $product->tags()->attach($tagIds);
            }

            $categoryNames = array_keys($variationData['variations']);
            shuffle($categoryNames);
            $selectedCategories = array_slice($categoryNames, 0, 3);

            $sortOrder = 1;
            foreach ($selectedCategories as $categoryName) {
                $variationsForCategory = $variationData['variations'][$categoryName];
                $variationCategory = $variationData['categories'][$categoryName];

                $numVariations = rand(2, min(4, count($variationsForCategory)));
                $selectedKeys = array_rand($variationsForCategory, $numVariations);
                if (!is_array($selectedKeys)) $selectedKeys = [$selectedKeys];

                foreach ($selectedKeys as $varName) {
                    $varDescription = $variationsForCategory[$varName];
                    $varBasePrice = $product->base_price + (rand(-1000, 2000) / 100);
                    $varFullPrice = round($varBasePrice * (1 + rand(15, 40) / 100), 2);
                    ProductVariation::create([
                        'product_id' => $product->id,
                        'variation_category_id' => $variationCategory->id,
                        'name' => $varName,
                        'description' => $varDescription,
                        'sku' => $product->sku . '-' . strtoupper(substr(preg_replace('/[^a-zA-Z0-9]/', '', $varName), 0, 2)) . $sortOrder,
                        'base_price' => $varBasePrice,
                        'full_price' => $varFullPrice,
                        'quantity' => rand(0, 100),
                        'sort_order' => $sortOrder++,
                        'published' => true,
                        'active' => true,
                        'is_fake' => true,
                    ]);
                    $variationCount++;
                }
            }

            if ($clients->count() > 0 && rand(1, 100) <= 60) {
                $numClientPrices = rand(1, min(4, $clients->count()));
                $randomClients = $clients->random($numClientPrices);
                foreach ($randomClients as $client) {
                    ClientPrice::firstOrCreate(
                        ['product_id' => $product->id, 'client_id' => $client->id],
                        [
                            'price' => $product->base_price * (rand(80, 95) / 100),
                            'published' => true,
                            'sku' => $product->sku ? $client->store_number . '-' . $product->sku : null,
                            'mpn' => $product->sku ? 'MPN-' . $product->sku : null,
                            'gtin' => $product->upc_code ? str_pad(rand(1000000000000, 9999999999999), 13, '0', STR_PAD_LEFT) : null,
                            'upc' => $product->upc_code,
                            'qb_1' => $product->qb_1,
                            'qb_2' => $product->qb_2,
                        ]
                    );
                }
            }

            $basePrice = $product->base_price;
            $tierGroup = $priceTierData['tier_group'];

            foreach ($priceTierData['tiers'] as $tierTemplate) {
                $discountPercent = $tierTemplate['discount_percent'];
                $price = $discountPercent > 0
                    ? round($basePrice * (1 - $discountPercent / 100), 2)
                    : $basePrice;

                ProductPriceTier::create([
                    'product_id' => $product->id,
                    'tier_group' => $tierGroup,
                    'min_quantity' => $tierTemplate['min_quantity'],
                    'max_quantity' => $tierTemplate['max_quantity'],
                    'price' => $price,
                    'discount_percent' => $discountPercent > 0 ? $discountPercent : null,
                    'label' => $tierTemplate['name'],
                    'sort_order' => $tierTemplate['sort_order'],
                    'is_fake' => true,
                ]);
            }

            if (count($accessoryItems) > 0) {
                $product->update(['show_accessories' => true]);

                $accessoriesByType = collect($accessoryItems)->groupBy('accessory_type_id');
                $typeIds = $accessoriesByType->keys()->toArray();
                shuffle($typeIds);

                $numTypes = rand(1, min(3, count($typeIds)));
                $selectedTypeIds = array_slice($typeIds, 0, $numTypes);

                foreach ($selectedTypeIds as $typeId) {
                    $typeAccessories = $accessoriesByType[$typeId]->toArray();

                    $numToAdd = rand(2, min(6, count($typeAccessories)));
                    shuffle($typeAccessories);
                    $selectedAccessories = array_slice($typeAccessories, 0, $numToAdd);

                    foreach ($selectedAccessories as $accessory) {
                        $product->accessories()->syncWithoutDetaching([
                            $accessory['id'] => [
                                'is_default' => rand(1, 100) <= 20,
                                'is_required' => rand(1, 100) <= 10,
                                'included_in_price' => rand(1, 100) <= 25,
                            ]
                        ]);
                    }
                }
            }

            self::generateDemoContent($product);

            self::addPlaceholderImage($product, 'product');
        }

        return ['products' => $products->count(), 'variations' => $variationCount];
    }

    public static function seedDummyAccessoryProducts(int $count = 5): array
    {
        set_time_limit(120);

        $data = self::ensureCategoriesAndTags();
        $categories = $data['categories'];
        $accessoryData = self::ensureAccessoryItems();
        $accessoryTypes = $accessoryData['types'];

        $accessories = Product::factory()->accessory()->count($count)->create();
        $accessoryTypeArray = array_values($accessoryTypes);
        $categoryArray = array_values($categories);

        foreach ($accessories as $accessory) {
            $randomType = $accessoryTypeArray[array_rand($accessoryTypeArray)];
            $accessory->update([
                'accessory_type_id' => $randomType->id
            ]);

            $randomCategory = $categoryArray[array_rand($categoryArray)];
            $accessory->categories()->attach($randomCategory->id);

            self::addPlaceholderImage($accessory, 'accessory');
        }

        return ['accessories' => $accessories->count()];
    }

    public static function seedDummyBundles(int $count = 1): array
    {
        set_time_limit(120);

        $data = self::ensureCategoriesAndTags();
        $categories = $data['categories'];
        $bundleCount = 0;
        $itemCount = 0;
        $variationCount = 0;

        $existingProducts = Product::where('product_type', 'standard')->where('is_fake', true)->get();

        $variationNames = ['Small', 'Medium', 'Large', 'Extra Large'];

        for ($i = 0; $i < $count; $i++) {
            $bundle = Product::factory()->asSet()->create([
                'name' => 'Gift Set #' . (Product::where('product_type', 'set')->count() + 1),
                'description' => 'A complete gift arrangement set with basket and accessories.',
            ]);

            $randomCategory = $categories[array_rand($categories)];
            $bundle->categories()->attach($randomCategory->id);

            self::addPlaceholderImage($bundle, 'bundle');

            $numVariations = rand(2, 4);
            $selectedVariations = array_rand(array_flip($variationNames), $numVariations);
            if (!is_array($selectedVariations)) $selectedVariations = [$selectedVariations];

            $sortOrder = 1;
            foreach ($selectedVariations as $varName) {
                $varBasePrice = $bundle->base_price + (rand(-500, 1000) / 100);
                $varFullPrice = round($varBasePrice * (1 + rand(15, 40) / 100), 2);
                ProductVariation::create([
                    'product_id' => $bundle->id,
                    'name' => $varName,
                    'sku' => $bundle->sku . '-' . strtoupper(substr($varName, 0, 2)),
                    'base_price' => $varBasePrice,
                    'full_price' => $varFullPrice,
                    'quantity' => rand(0, 50),
                    'sort_order' => $sortOrder++,
                    'published' => true,
                    'active' => true,
                    'is_fake' => true,
                ]);
                $variationCount++;
            }

            if ($existingProducts->count() >= 2) {
                $bundleItems = $existingProducts->random(min(rand(2, 4), $existingProducts->count()));
                $sortOrder = 1;
                foreach ($bundleItems as $item) {
                    ProductBundleItem::create([
                        'bundle_product_id' => $bundle->id,
                        'item_product_id' => $item->id,
                        'quantity' => 1,
                        'is_required' => $sortOrder === 1,
                        'is_selectable' => $sortOrder > 1,
                        'group_name' => $sortOrder === 1 ? 'Main Item' : 'Add-ons',
                        'sort_order' => $sortOrder++,
                        'is_fake' => true,
                    ]);
                    $itemCount++;
                }
            }
            $bundleCount++;
        }

        return ['bundles' => $bundleCount, 'bundle_items' => $itemCount, 'variations' => $variationCount];
    }

    public static function seedMoreVariations(): array
    {
        $productsWithoutVariations = Product::where('is_fake', true)
            ->whereIn('product_type', ['standard', 'set'])
            ->whereDoesntHave('variations')
            ->get();

        $variationCount = 0;
        $variationNames = ['Small', 'Medium', 'Large', 'Extra Large', '4"', '6"', '8"', '10"'];

        foreach ($productsWithoutVariations as $product) {
            $numVariations = rand(2, 4);
            $selectedVariations = array_rand(array_flip($variationNames), $numVariations);
            if (!is_array($selectedVariations)) $selectedVariations = [$selectedVariations];

            $sortOrder = 1;
            foreach ($selectedVariations as $varName) {
                $varBasePrice = $product->base_price + (rand(-200, 500) / 100);
                $varFullPrice = round($varBasePrice * (1 + rand(15, 40) / 100), 2);
                ProductVariation::create([
                    'product_id' => $product->id,
                    'name' => $varName,
                    'sku' => $product->sku . '-' . strtoupper(substr($varName, 0, 2)),
                    'base_price' => $varBasePrice,
                    'full_price' => $varFullPrice,
                    'quantity' => rand(0, 100),
                    'sort_order' => $sortOrder++,
                    'published' => true,
                    'active' => true,
                    'is_fake' => true,
                ]);
                $variationCount++;
            }
        }

        return ['products_updated' => $productsWithoutVariations->count(), 'variations' => $variationCount];
    }

    private static function addPlaceholderImage(Product $product, string $type): void
    {
        try {
            if (!function_exists('imagecreatetruecolor')) {
                \Log::warning('GD library not available for image generation');
                return;
            }

            $width = 600;
            $height = 400;
            $text = Str::limit($product->name, 30);

            $image = imagecreatetruecolor($width, $height);
            if (!$image) {
                \Log::error('Failed to create image with GD');
                return;
            }

            $bgColor = imagecolorallocate($image, 238, 238, 238);
            $textColor = imagecolorallocate($image, 49, 52, 60);

            imagefill($image, 0, 0, $bgColor);

            $fontSize = 5;
            $textWidth = imagefontwidth($fontSize) * strlen($text);
            $textHeight = imagefontheight($fontSize);
            $x = ($width - $textWidth) / 2;
            $y = ($height - $textHeight) / 2;
            imagestring($image, $fontSize, (int)$x, (int)$y, $text, $textColor);

            Storage::disk('public')->makeDirectory('products');
            $filename = "products/{$type}_" . uniqid() . '.png';
            $path = Storage::disk('public')->path($filename);

            if (!imagepng($image, $path)) {
                imagedestroy($image);
                \Log::error("Failed to save image to: {$path}");
                return;
            }

            imagedestroy($image);

            $product->addMediaFromDisk($filename, 'public')->toMediaCollection('photo');
        } catch (\Exception $e) {
            \Log::error('Error generating placeholder image: ' . $e->getMessage());
        }
    }

    public static function regenerateFakeProductImages(): array
    {
        $count = 0;
        $fakeProducts = Product::where('is_fake', true)->get();

        foreach ($fakeProducts as $product) {
            if (!$product->photo) {
                self::addPlaceholderImage($product, $product->product_type ?? 'product');
                $count++;
            }
        }

        return ['images_added' => $count];
    }

    public static function fillMissingPriceTiers(): array
    {
        $counts = ['products' => 0, 'tiers' => 0];

        $products = Product::whereDoesntHave('priceTiers')->get();

        foreach ($products as $product) {
            $basePrice = $product->base_price;
            $tierGroups = ['Standard Pricing', 'Volume Discounts', 'Wholesale Tiers', 'Bulk Pricing'];
            $tierGroup = $tierGroups[array_rand($tierGroups)];

            ProductPriceTier::create([
                'product_id' => $product->id,
                'tier_group' => $tierGroup,
                'min_quantity' => 1,
                'max_quantity' => 24,
                'price' => $basePrice,
                'discount_percent' => null,
                'label' => 'Regular',
                'sort_order' => 1,
                'is_fake' => $product->is_fake ?? false,
            ]);
            $counts['tiers']++;

            $discount2 = rand(5, 10);
            ProductPriceTier::create([
                'product_id' => $product->id,
                'tier_group' => $tierGroup,
                'min_quantity' => 25,
                'max_quantity' => 49,
                'price' => round($basePrice * (1 - $discount2 / 100), 2),
                'discount_percent' => $discount2,
                'label' => 'Bulk',
                'sort_order' => 2,
                'is_fake' => $product->is_fake ?? false,
            ]);
            $counts['tiers']++;

            $discount3 = rand(10, 15);
            ProductPriceTier::create([
                'product_id' => $product->id,
                'tier_group' => $tierGroup,
                'min_quantity' => 50,
                'max_quantity' => 99,
                'price' => round($basePrice * (1 - $discount3 / 100), 2),
                'discount_percent' => $discount3,
                'label' => 'Volume',
                'sort_order' => 3,
                'is_fake' => $product->is_fake ?? false,
            ]);
            $counts['tiers']++;

            if (rand(1, 100) <= 70) {
                $discount4 = rand(15, 25);
                ProductPriceTier::create([
                    'product_id' => $product->id,
                    'tier_group' => $tierGroup,
                    'min_quantity' => 100,
                    'max_quantity' => null,
                    'price' => round($basePrice * (1 - $discount4 / 100), 2),
                    'discount_percent' => $discount4,
                    'label' => 'Wholesale',
                    'sort_order' => 4,
                    'is_fake' => $product->is_fake ?? false,
                ]);
                $counts['tiers']++;
            }

            $counts['products']++;
        }

        return $counts;
    }

    public static function removeDummyProducts(): array
    {
        $counts = [
            'products' => 0,
            'variations' => 0,
            'categories' => 0,
            'tags' => 0,
            'accessories' => 0,
            'accessory_types' => 0,
            'variation_categories' => 0,
        ];

        $fakeProducts = Product::where('is_fake', true)->get();
        foreach ($fakeProducts as $product) {
            $product->categories()->detach();
            $product->tags()->detach();
            $product->clients()->detach();
            $product->accessories()->detach();

            $product->clientPrices()->delete();
            $counts['variations'] += $product->variations()->delete();
            $product->priceTiers()->delete();
            ProductBundleItem::where('bundle_product_id', $product->id)->delete();
            ProductBundleItem::where('item_product_id', $product->id)->delete();

            $product->clearMediaCollection('photo');

            $product->delete();
            $counts['products']++;
        }

        $counts['categories'] = ProductCategory::where('is_fake', true)->delete();

        $counts['tags'] = ProductTag::where('is_fake', true)->delete();

        $counts['accessories'] = Accessory::where('is_fake', true)->forceDelete();

        $counts['accessory_types'] = AccessoryType::where('is_fake', true)->forceDelete();

        $counts['variation_categories'] = VariationCategory::where('is_fake', true)->forceDelete();

        return $counts;
    }

    public static function seedDummyCart(): array
    {
        $counts = ['items' => 0];

        $products = Product::has('variations')->inRandomOrder()->limit(rand(3, 6))->get();

        if ($products->isEmpty()) {
            return $counts;
        }

        $userId = auth()->id();
        $sessionId = session()->getId();

        if ($userId) {
            Cart::where('user_id', $userId)->delete();
        } else {
            Cart::where('session_id', $sessionId)->delete();
        }

        foreach ($products as $product) {
            $variations = $product->variations()->inRandomOrder()->limit(rand(1, 3))->get();

            foreach ($variations as $variation) {
                $quantity = rand(1, 10);

                $clientId = auth()->check() ? auth()->user()->client_id : null;
                $price = $variation->getPriceForClient($clientId);

                Cart::create([
                    'user_id' => $userId,
                    'session_id' => $userId ? null : $sessionId,
                    'product_id' => $product->id,
                    'variation_id' => $variation->id,
                    'variation_name' => $variation->name,
                    'sku' => $variation->sku,
                    'quantity' => $quantity,
                    'price' => $price,
                    'is_fake' => true,
                ]);

                $counts['items']++;
            }
        }

        session(['cart_count' => $counts['items']]);

        return $counts;
    }

    public static function seedDummyOrders(): array
    {
        $counts = ['orders' => 0, 'items' => 0];

        $clients = Client::where('is_fake', true)->get();
        if ($clients->isEmpty()) {
            $clients = Client::limit(3)->get();
        }

        if ($clients->isEmpty()) {
            return $counts;
        }

        $products = Product::has('variations')->inRandomOrder()->limit(20)->get();

        if ($products->isEmpty()) {
            return $counts;
        }

        $statuses = ['new', 'processing', 'Fullfilled', 'Delivery'];

        $orderCount = rand(3, 5);

        for ($i = 0; $i < $orderCount; $i++) {
            $client = $clients->random();
            $orderDate = now()->subDays(rand(1, 30));

            $lastOrder = Order::orderBy('number', 'desc')->first();
            $nextNumber = $lastOrder ? ($lastOrder->number + 1) : 1000;

            $order = Order::create([
                'client_id' => $client->id,
                'number' => $nextNumber,
                'status' => $statuses[array_rand($statuses)],
                'delivery_date' => $orderDate->copy()->addDays(rand(3, 10)),
                'estimated_delivery' => $orderDate->copy()->addDays(rand(3, 10)),
                'special_request' => rand(0, 1) ? 'Please deliver to back entrance' : null,
                'internal_notes' => rand(0, 1) ? 'Customer prefers morning delivery' : null,
                'ordered_by_name' => $client->name,
                'ordered_by_phone' => $client->phone,
                'shipping_cost' => rand(0, 1) ? rand(10, 50) : 0,
                'created_at' => $orderDate,
                'team_id' => $client->team_id,
                'is_fake' => true,
            ]);

            $counts['orders']++;

            $itemCount = rand(3, 8);
            $orderTotal = 0;

            for ($j = 0; $j < $itemCount; $j++) {
                $product = $products->random();
                $variation = $product->variations()->inRandomOrder()->first();

                if (!$variation) continue;

                $quantity = rand(5, 50);
                $price = $variation->getPriceForClient($client->id);
                $totalPrice = $quantity * $price;
                $orderTotal += $totalPrice;

                OrderItem::create([
                    'items_id' => $order->id,
                    'product_id' => $product->id,
                    'sku' => $variation->sku,
                    'gtin' => $product->gtin,
                    'mpn' => $product->mpn,
                    'price' => $price,
                    'quantity' => $quantity,
                    'total_price' => $totalPrice,
                    'team_id' => $client->team_id,
                ]);

                $counts['items']++;
            }

            $order->update([
                'order_total' => $orderTotal,
                'total_price' => $orderTotal + ($order->shipping_cost ?? 0),
            ]);
        }

        return $counts;
    }

    public static function seedDummyFaqs(): array
    {
        $counts = ['faq_categories' => 0, 'faq_questions' => 0, 'skipped' => 0, 'existing_fake' => 0];

        $existingFakeCount = FaqCategory::where('is_fake', true)->count();
        if ($existingFakeCount > 0) {
            $counts['existing_fake'] = $existingFakeCount;
            return $counts;
        }

        $faqData = [
            'Ordering' => [
                'How do I place an order?' => 'You can place orders through our online ordering system. Simply browse our products, add items to your cart, and proceed to checkout. For wholesale accounts, please log in to access your special pricing.',
                'What are your minimum order requirements?' => 'Minimum order requirements vary by product type and customer account. Please contact our sales team for specific details about your account.',
                'Can I modify my order after placing it?' => 'Orders can be modified up to 24 hours before the scheduled delivery date. Please contact our customer service team to make changes.',
            ],
            'Shipping & Delivery' => [
                'What are your delivery areas?' => 'We deliver to most areas within our service region. Delivery schedules and availability vary by location. Contact us to confirm delivery to your area.',
                'How do I track my order?' => 'Once your order ships, you will receive a confirmation email with tracking information. You can also check your order status in your account dashboard.',
                'What if my plants arrive damaged?' => 'We take great care in packaging our plants. If any items arrive damaged, please contact us within 24 hours with photos and we will arrange a replacement or credit.',
            ],
            'Products & Care' => [
                'Do you offer plant care guides?' => 'Yes! Each product page includes basic care information. We also have detailed care guides available in our resources section.',
                'Are your plants grown locally?' => 'Many of our plants are grown in our local greenhouses. We also source from trusted partner growers to ensure the best quality and variety.',
                'Do you offer bulk discounts?' => 'Yes, we offer volume discounts for wholesale customers. Please contact our sales team for pricing on large orders.',
            ],
        ];

        foreach ($faqData as $categoryName => $questions) {
            $existingCategory = FaqCategory::where('category', $categoryName)->first();
            if ($existingCategory) {
                $counts['skipped']++;
                continue;
            }

            $category = FaqCategory::create([
                'category' => $categoryName,
                'is_fake' => true,
                'published' => true,
            ]);
            $counts['faq_categories']++;

            foreach ($questions as $question => $answer) {
                FaqQuestion::create([
                    'category_id' => $category->id,
                    'question' => $question,
                    'answer' => $answer,
                    'is_fake' => true,
                    'published' => true,
                ]);
                $counts['faq_questions']++;
            }
        }

        return $counts;
    }

    public static function removeDummyFaqs(): array
    {
        $counts = [
            'faq_categories' => 0,
            'faq_questions' => 0,
        ];

        $counts['faq_questions'] = FaqQuestion::where('is_fake', true)->delete();

        $counts['faq_categories'] = FaqCategory::where('is_fake', true)->delete();

        return $counts;
    }

    public static function seedDummyPages(): array
    {
        $counts = ['created' => 0, 'skipped' => 0, 'existing_fake' => 0];

        $existingFakeCount = ContentPage::where('is_fake', true)->count();
        if ($existingFakeCount > 0) {
            $counts['existing_fake'] = $existingFakeCount;
            return $counts;
        }

        $pages = [
            [
                'title' => 'About Us',
                'slug' => 'about-us',
                'page_type' => 'general',
                'page_text' => '<h2>Welcome to Our Nursery</h2><p>We are a family-owned wholesale plant nursery dedicated to providing the highest quality plants to garden centers, landscapers, and retailers throughout the region.</p><h3>Our Mission</h3><p>To grow and deliver exceptional plants while providing outstanding customer service and supporting sustainable growing practices.</p><h3>Our History</h3><p>Founded over 25 years ago, we have grown from a small family operation to one of the region\'s leading wholesale nurseries. Our commitment to quality and customer satisfaction has remained unchanged.</p>',
                'excerpt' => 'Learn about our family-owned wholesale nursery and our commitment to quality.',
            ],
            [
                'title' => 'How to Order',
                'slug' => 'how-to-order',
                'page_type' => 'how_to_order',
                'page_text' => '<h2>Ordering Made Easy</h2><p>We\'ve streamlined our ordering process to make it as simple as possible for our wholesale customers.</p><h3>Online Ordering</h3><p>Log in to your account to access our full catalog with your custom pricing. Add items to your cart and submit your order for processing.</p><h3>Phone Orders</h3><p>Prefer to order by phone? Our sales team is available Monday through Friday to assist you with your order.</p><h3>Order Deadlines</h3><p>Orders placed by 2 PM will be processed for next-day delivery (where available). Please check your delivery schedule for specific cutoff times.</p>',
                'excerpt' => 'Learn how to place orders through our online system or by phone.',
            ],
            [
                'title' => 'Delivery Information',
                'slug' => 'delivery-info',
                'page_type' => 'delivery_info',
                'page_text' => '<h2>Delivery Information</h2><p>We offer reliable delivery service throughout our coverage area.</p><h3>Delivery Schedule</h3><p>Deliveries are made Monday through Friday. Your specific delivery day depends on your location. Check your account for your scheduled delivery days.</p><h3>Delivery Requirements</h3><p>Please ensure someone is available to receive and inspect your delivery. All claims for damaged or missing items must be made at the time of delivery.</p><h3>Special Deliveries</h3><p>Need a delivery outside your regular schedule? Contact us to arrange special delivery options (additional fees may apply).</p>',
                'excerpt' => 'Information about our delivery schedules, areas, and requirements.',
            ],
            [
                'title' => 'Contact Us',
                'slug' => 'contact',
                'page_type' => 'general',
                'page_text' => '<h2>Contact Us</h2><p>We\'d love to hear from you! Reach out to our team for questions, orders, or support.</p><h3>Sales Team</h3><p>Phone: (801) 555-1234<br>Email: sales@example.com</p><h3>Customer Service</h3><p>Phone: (801) 555-5678<br>Email: support@example.com</p><h3>Hours</h3><p>Monday - Friday: 7:00 AM - 4:00 PM<br>Saturday: 8:00 AM - 12:00 PM<br>Sunday: Closed</p>',
                'excerpt' => 'Get in touch with our sales and customer service teams.',
            ],
        ];

        foreach ($pages as $pageData) {
            $existingPage = ContentPage::where('slug', $pageData['slug'])->first();
            if ($existingPage) {
                $counts['skipped']++;
                continue;
            }

            ContentPage::create(array_merge($pageData, [
                'is_fake' => true,
                'published' => true,
            ]));
            $counts['created']++;
        }

        return $counts;
    }

    public static function removeDummyPages(): int
    {
        return ContentPage::where('is_fake', true)->delete();
    }
}
