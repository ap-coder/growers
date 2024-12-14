<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Team;
use App\Models\ClientPrice;
use App\Models\Client;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
    Product::factory(24)->withClientPrices()->create();
    ProductCategory::factory(5)->create();
    Client::factory(5)->create();
    Location::factory(5)->create();
    Team::factory(5)->create();
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'published' => $this->faker->boolean,
            'featured' => $this->faker->boolean,
            'quantity' => $this->faker->numberBetween(1, 100),
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'team_id' => Team::pluck('id')->random(),
            'created_at' => \Illuminate\Support\Facades\Date::now(),
            'updated_at' => \Illuminate\Support\Facades\Date::now(),
        ];
    }

    // Optionally, define a state to create a product with associated client prices
    public function withClientPrices()
    {
        return $this->afterCreating(function (Product $product) {
            ClientPrice::factory(3)->create(['product_id' => $product->id]); // Creating 3 client prices for each product
        });
    }

    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            // Generate a temporary 600x600 image
            $imagePath = $this->faker->image(
                Storage::path('temp'), // Save in the temporary storage path
                600,
                600,
                null,
                false
            );

            // Attach the image to the photo media collection
            $product
                ->addMedia(Storage::path("temp/{$imagePath}"))
                ->toMediaCollection('photo');

            // Cleanup the temporary image
            Storage::delete("temp/{$imagePath}");
        });
    }
}
