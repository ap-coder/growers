<?php

namespace Database\Factories;

use App\Models\ProductTag;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductTagFactory extends Factory
{
    protected $model = ProductTag::class;

    private array $tags = [
        'Seasonal', 'Valentines', 'Spring', 'Summer', 'Fall', 'Christmas',
        'Mothers Day', 'Easter', 'Thanksgiving', 'New Arrivals', 'Best Seller',
        'Clearance', 'Premium', 'Eco-Friendly', 'Handmade', 'Local',
    ];

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement($this->tags),
            'is_fake' => true,
        ];
    }
}
