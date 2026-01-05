<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    // Product sizes
    private array $sizes = ['4"', '6"', '8"', '10"', '12"', '14"', 'Small', 'Medium', 'Large', 'XL'];
    private array $potSizes = ['4"', '6"', '8"', '10"', '12"', '14"'];
    private array $colors = ['Natural', 'White', 'Brown', 'Gray', 'Black', 'Green', 'Red', 'Blue'];
    
    // Plants - the main products for a plant wholesaler
    private array $tropicalPlants = ['Monstera Deliciosa', 'Bird of Paradise', 'Fiddle Leaf Fig', 'Rubber Plant', 'Dracaena', 'Croton', 'Alocasia', 'Calathea', 'Dieffenbachia', 'Schefflera'];
    private array $succulents = ['Echeveria', 'Jade Plant', 'Aloe Vera', 'Haworthia', 'Sedum', 'Crassula', 'Sempervivum', 'Agave', 'Kalanchoe', 'String of Pearls'];
    private array $foliagePlants = ['Pothos', 'Philodendron', 'Peace Lily', 'Snake Plant', 'Spider Plant', 'ZZ Plant', 'Chinese Evergreen', 'Fern', 'Ivy', 'Prayer Plant'];
    private array $floweringPlants = ['Orchid', 'Anthurium', 'Bromeliad', 'African Violet', 'Begonia', 'Cyclamen', 'Hibiscus', 'Gardenia', 'Jasmine', 'Azalea'];
    private array $outdoorPlants = ['Hydrangea', 'Lavender', 'Rose Bush', 'Boxwood', 'Japanese Maple', 'Ornamental Grass', 'Hosta', 'Fuchsia', 'Geranium', 'Petunia'];
    
    // Containers/Pots - accessories for plants
    private array $basketPrefixes = ['Wicker', 'Rattan', 'Bamboo', 'Willow', 'Seagrass', 'Natural', 'Rustic'];
    private array $basketTypes = ['Basket', 'Planter', 'Container', 'Pot Cover', 'Cache Pot'];
    private array $ceramicTypes = ['Ceramic Pot', 'Glazed Planter', 'Terra Cotta', 'Stoneware Pot', 'Porcelain Vase'];
    private array $tinTypes = ['Tin Bucket', 'Metal Planter', 'Galvanized Pot', 'Zinc Container'];
    private array $woodTypes = ['Wood Crate', 'Wooden Box', 'Cedar Planter', 'Pine Container', 'Oak Basket'];
    
    private array $seasonalTags = ['Spring', 'Summer', 'Fall', 'Christmas', 'Valentines', 'Mothers Day', 'Easter'];

    public function definition(): array
    {
        // Weight toward plants (70%) vs containers/accessories (30%)
        $category = $this->faker->randomElement([
            'tropical', 'tropical', 'succulent', 'foliage', 'foliage', 'flowering', 'outdoor', // Plants (70%)
            'basket', 'ceramic', 'tin' // Containers (30%)
        ]);
        
        // Plants are standard products, containers are accessories
        $productType = in_array($category, ['tropical', 'succulent', 'foliage', 'flowering', 'outdoor']) ? 'standard' : 'accessory';
        
        $name = $this->generateProductName($category);
        
        $basePrice = $this->faker->randomFloat(2, 2.50, 45.00);
        $fullPrice = round($basePrice * $this->faker->randomFloat(2, 1.15, 1.40), 2); // Full price 15-40% higher
        $baseCost = round($basePrice * $this->faker->randomFloat(2, 0.40, 0.65), 2); // Cost 35-60% of base price
        
        return [
            'name' => $name,
            'description' => $this->generateDescription($category),
            'product_type' => $productType,
            'base_price' => $basePrice,
            'full_price' => $fullPrice,
            'base_cost' => $baseCost,
            'sku' => strtoupper($this->faker->unique()->bothify('???-###')),
            'upc_code' => $this->faker->unique()->ean13(),
            'quantity' => $this->faker->numberBetween(0, 500),
            'published' => true,
            'featured' => $this->faker->boolean(20),
            'is_fake' => true,
            'layout' => $this->faker->randomElement(array_keys(Product::LAYOUT_SELECT)),
        ];
    }

    private function generateProductName(string $category): string
    {
        $size = $this->faker->randomElement($this->potSizes);
        $color = $this->faker->randomElement($this->colors);
        
        return match($category) {
            // Plants
            'tropical' => $this->faker->randomElement($this->tropicalPlants) . " - {$size}",
            'succulent' => $this->faker->randomElement($this->succulents) . " - {$size}",
            'foliage' => $this->faker->randomElement($this->foliagePlants) . " - {$size}",
            'flowering' => $this->faker->randomElement($this->floweringPlants) . " - {$size}",
            'outdoor' => $this->faker->randomElement($this->outdoorPlants) . " - {$size}",
            // Containers/Accessories
            'basket' => "{$size} {$color} " . $this->faker->randomElement($this->basketPrefixes) . ' ' . $this->faker->randomElement($this->basketTypes),
            'ceramic' => "{$size} {$color} " . $this->faker->randomElement($this->ceramicTypes),
            'tin' => "{$size} {$color} " . $this->faker->randomElement($this->tinTypes),
            'wood' => "{$size} " . $this->faker->randomElement($this->woodTypes),
            default => "{$size} {$color} Container",
        };
    }

    private function generateDescription(string $category): string
    {
        $descriptions = [
            // Plant descriptions
            'tropical' => [
                'Stunning tropical plant with lush, vibrant foliage. Perfect statement piece for any interior.',
                'Exotic tropical specimen, greenhouse grown. Adds instant drama to any space.',
                'Bold, architectural tropical plant. Thrives in bright, indirect light.',
                'Premium quality tropical, professionally grown and acclimated for indoor success.',
            ],
            'succulent' => [
                'Hardy succulent, perfect for beginners. Drought-tolerant and low maintenance.',
                'Beautiful succulent with unique form. Ideal for sunny windowsills.',
                'Easy-care succulent, great for terrariums or dish gardens.',
                'Compact succulent with striking appearance. Water sparingly for best results.',
            ],
            'foliage' => [
                'Healthy, vibrant foliage plant ready for display. Easy care, low maintenance.',
                'Lush green foliage plant, air-purifying qualities. Perfect for home or office.',
                'Classic foliage plant with beautiful leaf patterns. Thrives in indirect light.',
                'Full, bushy foliage plant. Excellent for adding greenery to any room.',
            ],
            'flowering' => [
                'Beautiful flowering plant in full bloom. Long-lasting color for any space.',
                'Gorgeous blooms on healthy, well-rooted plant. Makes a perfect gift.',
                'Vibrant flowering specimen, greenhouse fresh. Reblooms with proper care.',
                'Stunning flowers on compact, well-branched plant. Adds instant color.',
            ],
            'outdoor' => [
                'Hardy outdoor plant, ready for landscape or container planting.',
                'Garden-ready specimen, professionally grown. Excellent for borders or beds.',
                'Versatile outdoor plant, thrives in various conditions. Low maintenance.',
                'Premium quality outdoor plant, well-rooted and ready to thrive.',
            ],
            // Container descriptions
            'basket' => [
                'Handwoven natural fiber basket, perfect for floral arrangements.',
                'Durable wicker construction with waterproof liner included.',
                'Classic design suitable for any occasion.',
                'Versatile container for plants or gift arrangements.',
            ],
            'ceramic' => [
                'High-quality glazed ceramic with drainage hole.',
                'Beautiful finish, ideal for indoor plants.',
                'Elegant design complements any decor.',
                'Sturdy construction with smooth glaze.',
            ],
            'tin' => [
                'Rustic metal container with vintage appeal.',
                'Galvanized finish prevents rust and corrosion.',
                'Perfect for seasonal arrangements.',
                'Lightweight yet durable construction.',
            ],
            'wood' => [
                'Natural wood construction with rustic charm.',
                'Sturdy design supports heavy arrangements.',
                'Eco-friendly and biodegradable material.',
                'Hand-finished with natural stain.',
            ],
        ];
        
        return $this->faker->randomElement($descriptions[$category] ?? $descriptions['foliage']);
    }

    public function accessory(): static
    {
        $basePrice = $this->faker->randomFloat(2, 0.50, 8.00);
        return $this->state(fn (array $attributes) => [
            'product_type' => 'accessory',
            'base_price' => $basePrice,
            'full_price' => round($basePrice * 1.25, 2),
            'base_cost' => round($basePrice * 0.50, 2),
        ]);
    }

    public function asSet(): static
    {
        return $this->state(fn (array $attributes) => [
            'product_type' => 'set',
            'bundle_price_type' => $this->faker->randomElement(['calculated', 'fixed', 'discount_percent']),
            'bundle_price_override' => $this->faker->randomFloat(2, 15.00, 75.00),
            'bundle_discount' => $this->faker->randomFloat(2, 5, 20),
        ]);
    }

    public function unpublished(): static
    {
        return $this->state(fn (array $attributes) => [
            'published' => false,
        ]);
    }

    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'featured' => true,
        ]);
    }
}
