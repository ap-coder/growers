<?php

namespace Database\Factories;

use App\Models\FaqCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class FaqCategoryFactory extends Factory
{
    protected $model = FaqCategory::class;

    private array $categories = [
        'Ordering',
        'Shipping & Delivery',
        'Returns & Refunds',
        'Account & Billing',
        'Products',
        'Wholesale',
        'General',
    ];

    public function definition(): array
    {
        return [
            'category' => $this->faker->unique()->randomElement($this->categories),
            'published' => true,
            'is_fake' => true,
        ];
    }
}
