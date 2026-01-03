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
use App\Models\FaqCategory;
use App\Models\FaqQuestion;
use App\Models\ContentPage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class DummyProductsSeeder extends Seeder
{
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
    
    /**
     * Ensure categories and tags exist (called by other seed methods)
     */
    private static function ensureCategoriesAndTags(): array
    {
        // Create fake categories (only once) - Plant wholesaler focused
        $categoryNames = [
            // Plant categories
            'Tropical Plants', 'Succulents', 'Foliage Plants', 'Flowering Plants', 'Outdoor Plants',
            // Container/accessory categories
            'Baskets', 'Ceramics', 'Tins', 'Planters', 'Supplies'
        ];
        $categories = [];
        foreach ($categoryNames as $name) {
            $categories[$name] = ProductCategory::firstOrCreate(
                ['name' => $name],
                ['is_fake' => true, 'published' => true]
            );
        }
        
        // Create fake tags (only once)
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
    
    /**
     * Ensure accessory types and items exist
     */
    private static function ensureAccessoryItems(): array
    {
        $accessoryTypes = [
            'Card Holders' => AccessoryType::firstOrCreate(['name' => 'Card Holders'], ['published' => true, 'sort_order' => 1]),
            'Ribbons' => AccessoryType::firstOrCreate(['name' => 'Ribbons'], ['published' => true, 'sort_order' => 2]),
            'Picks' => AccessoryType::firstOrCreate(['name' => 'Picks'], ['published' => true, 'sort_order' => 3]),
            'Bows' => AccessoryType::firstOrCreate(['name' => 'Bows'], ['published' => true, 'sort_order' => 4]),
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
                    ]
                );
            }
        }
        
        return ['types' => $accessoryTypes, 'items' => $accessoryItems];
    }
    
    /**
     * Seed standard products (15 at a time)
     */
    public static function seedDummyProducts(int $count = 15): array
    {
        $data = self::ensureCategoriesAndTags();
        $categories = $data['categories'];
        $tags = $data['tags'];
        $accessoryData = self::ensureAccessoryItems();
        $accessoryItems = $accessoryData['items'];
        $clients = Client::all();
        
        $products = Product::factory()->count($count)->create();
        $variationCount = 0;
        
        foreach ($products as $product) {
            // Attach 1-2 random categories
            $numCategories = rand(1, 2);
            $randomCategoryKeys = array_rand($categories, min($numCategories, count($categories)));
            if (!is_array($randomCategoryKeys)) $randomCategoryKeys = [$randomCategoryKeys];
            foreach ($randomCategoryKeys as $key) {
                $product->categories()->syncWithoutDetaching([$categories[$key]->id]);
            }
            
            // Attach 0-3 random tags
            $numTags = rand(0, 3);
            if ($numTags > 0) {
                $randomTags = array_rand($tags, min($numTags, count($tags)));
                if (!is_array($randomTags)) $randomTags = [$randomTags];
                $tagIds = array_map(fn($key) => $tags[$key]->id, $randomTags);
                $product->tags()->attach($tagIds);
            }
            
            // Add 2-4 variations to ~60% of products
            if (rand(1, 100) <= 60) {
                $variationNames = ['Small', 'Medium', 'Large', 'Extra Large', '4"', '6"', '8"', '10"'];
                $numVariations = rand(2, 4);
                $selectedVariations = array_rand(array_flip($variationNames), $numVariations);
                if (!is_array($selectedVariations)) $selectedVariations = [$selectedVariations];
                
                $sortOrder = 1;
                foreach ($selectedVariations as $varName) {
                    $varBasePrice = $product->base_price + (rand(-200, 500) / 100);
                    $varFullPrice = round($varBasePrice * (1 + rand(15, 40) / 100), 2); // 15-40% higher
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
            
            // Add client-specific prices to ~40% of products
            if ($clients->count() > 0 && rand(1, 100) <= 40) {
                $numClientPrices = rand(1, min(3, $clients->count()));
                $randomClients = $clients->random($numClientPrices);
                foreach ($randomClients as $client) {
                    ClientPrice::firstOrCreate(
                        ['product_id' => $product->id, 'client_id' => $client->id],
                        ['price' => $product->base_price * (rand(80, 95) / 100)]
                    );
                }
            }
            
            // Add quantity price tiers to ~30% of products
            if (rand(1, 100) <= 30) {
                $basePrice = $product->base_price;
                $tierLabels = ['', 'Bulk', 'Wholesale', 'Volume Discount'];
                
                // Tier 1: 1-24 at base price
                ProductPriceTier::create([
                    'product_id' => $product->id,
                    'min_quantity' => 1,
                    'max_quantity' => 24,
                    'price' => $basePrice,
                    'label' => '',
                    'sort_order' => 1,
                ]);
                
                // Tier 2: 25-49 at 5-10% off
                ProductPriceTier::create([
                    'product_id' => $product->id,
                    'min_quantity' => 25,
                    'max_quantity' => 49,
                    'price' => round($basePrice * (rand(90, 95) / 100), 2),
                    'label' => $tierLabels[array_rand($tierLabels)],
                    'sort_order' => 2,
                ]);
                
                // Tier 3: 50-99 at 10-15% off
                ProductPriceTier::create([
                    'product_id' => $product->id,
                    'min_quantity' => 50,
                    'max_quantity' => 99,
                    'price' => round($basePrice * (rand(85, 90) / 100), 2),
                    'label' => 'Bulk',
                    'sort_order' => 3,
                ]);
                
                // Tier 4: 100+ at 15-25% off
                ProductPriceTier::create([
                    'product_id' => $product->id,
                    'min_quantity' => 100,
                    'max_quantity' => null,
                    'price' => round($basePrice * (rand(75, 85) / 100), 2),
                    'label' => 'Wholesale',
                    'sort_order' => 4,
                ]);
            }
            
            // Attach 1-4 random accessories to ~50% of products
            if (count($accessoryItems) > 0 && rand(1, 100) <= 50) {
                $numAccessories = rand(1, min(4, count($accessoryItems)));
                $randomAccessories = array_rand($accessoryItems, $numAccessories);
                if (!is_array($randomAccessories)) $randomAccessories = [$randomAccessories];
                
                foreach ($randomAccessories as $idx) {
                    $product->accessories()->syncWithoutDetaching([
                        $accessoryItems[$idx]->id => [
                            'is_default' => rand(1, 100) <= 20,
                            'is_required' => rand(1, 100) <= 10,
                        ]
                    ]);
                }
            }
            
            // Add placeholder image
            self::addPlaceholderImage($product, 'product');
        }
        
        return ['products' => $products->count(), 'variations' => $variationCount];
    }
    
    /**
     * Seed accessory products (5 at a time)
     */
    public static function seedDummyAccessoryProducts(int $count = 5): array
    {
        $data = self::ensureCategoriesAndTags();
        $categories = $data['categories'];
        $accessoryData = self::ensureAccessoryItems();
        $accessoryTypes = $accessoryData['types'];
        
        $accessories = Product::factory()->accessory()->count($count)->create();
        foreach ($accessories as $accessory) {
            $accessory->update([
                'accessory_type_id' => $accessoryTypes[array_rand($accessoryTypes)]->id
            ]);
            
            $randomCategory = $categories[array_rand($categories)];
            $accessory->categories()->attach($randomCategory->id);
            
            self::addPlaceholderImage($accessory, 'accessory');
        }
        
        return ['accessories' => $accessories->count()];
    }
    
    /**
     * Seed bundle/set products (1 at a time)
     */
    public static function seedDummyBundles(int $count = 1): array
    {
        $data = self::ensureCategoriesAndTags();
        $categories = $data['categories'];
        $bundleCount = 0;
        $itemCount = 0;
        $variationCount = 0;
        
        // Get existing standard products to add to bundles
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
            
            // Add variations to the bundle (e.g., Small Set, Medium Set, Large Set)
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
            
            // Add 2-4 products to the bundle
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
    
    /**
     * Add more variations to existing products without variations
     * Includes standard products and sets/bundles
     */
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
    
    /**
     * Helper to add placeholder image to a product
     */
    private static function addPlaceholderImage(Product $product, string $type): void
    {
        try {
            $width = 600;
            $height = 400;
            $text = $product->name;
            // Use .png extension to force PNG format (not SVG)
            $url = "https://placehold.co/{$width}x{$height}/EEE/31343C.png?font=poppins&text=" . urlencode($text);
            
            $response = Http::timeout(15)->get($url);
            
            if ($response->successful()) {
                Storage::disk('public')->makeDirectory('products');
                $filename = "products/{$type}_" . uniqid() . '.png';
                Storage::disk('public')->put($filename, $response->body());
                $product->addMediaFromDisk($filename, 'public')->toMediaCollection('photo');
            }
        } catch (\Exception $e) {
            // Silently skip image errors
        }
    }

    /**
     * Remove fake products only
     */
    public static function removeDummyProducts(): array
    {
        $counts = [
            'products' => 0,
            'categories' => 0,
            'tags' => 0,
            'variations' => 0,
        ];
        
        // Remove fake products and their relationships
        $fakeProducts = Product::where('is_fake', true)->get();
        foreach ($fakeProducts as $product) {
            $product->categories()->detach();
            $product->tags()->detach();
            $product->accessories()->detach();
            $product->clientPrices()->delete();
            $counts['variations'] += $product->variations()->delete();
            if (method_exists($product, 'priceTiers')) {
                $product->priceTiers()->delete();
            }
            ProductBundleItem::where('bundle_product_id', $product->id)->delete();
            ProductBundleItem::where('item_product_id', $product->id)->delete();
            $product->clearMediaCollection('photo');
            $product->forceDelete();
            $counts['products']++;
        }
        
        // Remove fake categories
        $counts['categories'] = ProductCategory::where('is_fake', true)->delete();
        
        // Remove fake tags
        $counts['tags'] = ProductTag::where('is_fake', true)->delete();
        
        return $counts;
    }
    
    /**
     * Seed dummy FAQs
     */
    public static function seedDummyFaqs(): array
    {
        $counts = ['faq_categories' => 0, 'faq_questions' => 0, 'skipped' => 0, 'existing_fake' => 0];
        
        // Check if dummy FAQs already exist
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
            // Check if category already exists
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

    /**
     * Remove fake FAQs only
     */
    public static function removeDummyFaqs(): array
    {
        $counts = [
            'faq_categories' => 0,
            'faq_questions' => 0,
        ];
        
        // Remove fake FAQ questions first (foreign key constraint)
        $counts['faq_questions'] = FaqQuestion::where('is_fake', true)->delete();
        
        // Remove fake FAQ categories
        $counts['faq_categories'] = FaqCategory::where('is_fake', true)->delete();
        
        return $counts;
    }
    
    /**
     * Seed dummy content pages
     */
    public static function seedDummyPages(): array
    {
        $counts = ['created' => 0, 'skipped' => 0, 'existing_fake' => 0];
        
        // Check if dummy pages already exist
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
            // Check if page with this slug already exists
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

    /**
     * Remove fake content pages only
     */
    public static function removeDummyPages(): int
    {
        return ContentPage::where('is_fake', true)->delete();
    }
}
