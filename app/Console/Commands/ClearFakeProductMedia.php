<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class ClearFakeProductMedia extends Command
{
    protected $signature = 'products:clear-fake-media';
    protected $description = 'Clear media from fake products and regenerate with proper PNG images';

    public function handle()
    {
        $fakeProducts = Product::where('is_fake', true)->get();
        $this->info("Found {$fakeProducts->count()} fake products");
        
        foreach ($fakeProducts as $product) {
            $product->clearMediaCollection('photo');
            $product->clearMediaCollection('additional_photos');
            $this->line("Cleared media for: {$product->name}");
        }
        
        $this->info('Done! Run DummyProductsSeeder to regenerate images.');
    }
}
