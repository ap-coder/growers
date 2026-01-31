<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCollection;
use App\Models\ProductCollectionItem;
use Illuminate\Database\Seeder;

class DummyProductCollectionsSeeder extends Seeder
{
    public function run(): void
    {
        $this->createDummyCollections();
    }

    public function createDummyCollections(): array
    {
        $products = Product::where('published', true)->get();
        
        if ($products->count() < 4) {
            return [
                'success' => false,
                'message' => 'Need at least 4 published products to create collections. Currently have ' . $products->count() . '.',
            ];
        }

        $created = 0;
        $layouts = ProductCollection::LAYOUT_SELECT;
        $sortOrder = 1;

        foreach ($layouts as $layoutKey => $layoutName) {
            // Check if collection with this layout already exists as fake
            if (ProductCollection::where('layout_type', $layoutKey)->where('is_fake', true)->exists()) {
                continue;
            }

            // Create collection
            $collection = ProductCollection::create([
                'name' => $layoutName . ' Collection',
                'slug' => \Illuminate\Support\Str::slug($layoutName . ' Collection'),
                'description' => null,
                'layout_type' => $layoutKey,
                'published' => true,
                'show_on_homepage' => $sortOrder <= 3, // First 3 show on homepage
                'sort_order' => $sortOrder,
                'background_color' => null,
                'text_color' => null,
                'columns' => in_array($layoutKey, ['grid', 'masonry']) ? 4 : 3,
                'is_fake' => true,
            ]);

            // Add 4-8 random products to each collection
            $collectionProducts = $products->random(min($products->count(), rand(4, 8)));
            $itemSort = 1;
            
            foreach ($collectionProducts as $product) {
                ProductCollectionItem::create([
                    'product_collection_id' => $collection->id,
                    'product_id' => $product->id,
                    'sort_order' => $itemSort,
                    'is_featured' => $itemSort <= 2, // First 2 are featured
                ]);
                $itemSort++;
            }

            $created++;
            $sortOrder++;
        }

        return [
            'success' => true,
            'message' => "Created {$created} product collections.",
            'count' => $created,
        ];
    }

    public function removeDummyCollections(): array
    {
        // Get all fake collection IDs
        $fakeCollectionIds = ProductCollection::where('is_fake', true)->pluck('id');
        
        // Delete collection items first
        $itemsDeleted = ProductCollectionItem::whereIn('product_collection_id', $fakeCollectionIds)->delete();
        
        // Delete collections
        $collectionsDeleted = ProductCollection::where('is_fake', true)->delete();

        return [
            'success' => true,
            'message' => "Removed {$collectionsDeleted} collections and {$itemsDeleted} collection items.",
            'collections' => $collectionsDeleted,
            'items' => $itemsDeleted,
        ];
    }
}
