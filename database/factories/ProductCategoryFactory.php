<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductCategoryFactory extends Factory
{
    protected $model = ProductCategory::class;

    private array $categories = [
        'Baskets' => 'Wicker, rattan, and natural fiber baskets for floral arrangements.',
        'Ceramics' => 'Glazed and unglazed ceramic pots and planters.',
        'Tins' => 'Metal and galvanized containers with rustic appeal.',
        'Wood' => 'Wooden crates, boxes, and natural wood planters.',
        'Bamboo' => 'Sustainable bamboo containers and planters.',
        'Foliage' => 'Live plants and greenery for arrangements.',
        'Novelty' => 'Unique and themed containers for special occasions.',
        'Supplies' => 'Floral supplies, foam, wire, and accessories.',
        'Specialty' => 'Premium and specialty items.',
        'Seasonal' => 'Holiday and seasonal containers.',
    ];

    public function definition(): array
    {
        $name = $this->faker->unique()->randomElement(array_keys($this->categories));
        
        return [
            'name' => $name,
            'description' => $this->categories[$name] ?? $this->faker->sentence(),
            'published' => true,
            'is_fake' => true,
        ];
    }
}
