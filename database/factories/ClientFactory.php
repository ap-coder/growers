<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    // Realistic Utah-area business names relevant to plant/floral wholesale
    private array $clientNames = [
        ['name' => 'Harmon\'s Grocery', 'prefix' => 'HRM', 'upc' => true],
        ['name' => 'Smith\'s Food & Drug', 'prefix' => 'SMT', 'upc' => true],
        ['name' => 'Mountain View Florist', 'prefix' => 'MVF', 'upc' => false],
        ['name' => 'Valley Garden Center', 'prefix' => 'VGC', 'upc' => false],
        ['name' => 'Associated Food Stores', 'prefix' => 'AFS', 'upc' => true],
        ['name' => 'Macey\'s Grocery', 'prefix' => 'MAC', 'upc' => true],
        ['name' => 'Dan\'s Fresh Market', 'prefix' => 'DAN', 'upc' => true],
        ['name' => 'Bloom Floral Design', 'prefix' => 'BLM', 'upc' => false],
        ['name' => 'Green Thumb Nursery', 'prefix' => 'GTN', 'upc' => false],
        ['name' => 'Wasatch Garden Center', 'prefix' => 'WGC', 'upc' => false],
        ['name' => 'Park City Florist', 'prefix' => 'PCF', 'upc' => false],
        ['name' => 'Fresh Market Foods', 'prefix' => 'FMF', 'upc' => true],
    ];

    public function definition(): array
    {
        $client = $this->faker->unique()->randomElement($this->clientNames);
        $storeNumber = $client['prefix'] . '-' . $this->faker->numberBetween(100, 999);
        
        return [
            'name' => $client['name'],
            'store_number' => $storeNumber,
            'contact_name' => $this->faker->name(),
            'contact_phone' => $this->faker->phoneNumber(),
            'contact_email' => $this->faker->companyEmail(),
            'requires_upc' => $client['upc'],
            'published' => true,
            'is_fake' => true,
        ];
    }

    public function grocery(): static
    {
        return $this->state(fn (array $attributes) => [
            'requires_upc' => true,
        ]);
    }

    public function florist(): static
    {
        return $this->state(fn (array $attributes) => [
            'requires_upc' => false,
        ]);
    }
}
