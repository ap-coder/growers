<?php

namespace Database\Factories;

use App\Models\ClientAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientAddressFactory extends Factory
{
    protected $model = ClientAddress::class;

    private array $utahCities = [
        ['city' => 'Salt Lake City', 'state' => 'UT', 'zip' => '84101'],
        ['city' => 'Provo', 'state' => 'UT', 'zip' => '84601'],
        ['city' => 'West Valley City', 'state' => 'UT', 'zip' => '84119'],
        ['city' => 'Sandy', 'state' => 'UT', 'zip' => '84070'],
        ['city' => 'Orem', 'state' => 'UT', 'zip' => '84057'],
        ['city' => 'Ogden', 'state' => 'UT', 'zip' => '84401'],
        ['city' => 'St. George', 'state' => 'UT', 'zip' => '84770'],
        ['city' => 'Layton', 'state' => 'UT', 'zip' => '84041'],
        ['city' => 'Park City', 'state' => 'UT', 'zip' => '84060'],
        ['city' => 'Midvale', 'state' => 'UT', 'zip' => '84047'],
    ];

    public function definition(): array
    {
        $location = $this->faker->randomElement($this->utahCities);
        
        return [
            'address_type' => $this->faker->randomElement(array_keys(ClientAddress::TYPE_SELECT)),
            'label' => null,
            'nickname' => null,
            'is_primary' => false,
            'is_fake' => false,
            'address_line_1' => $this->faker->streetAddress(),
            'address_line_2' => $this->faker->optional(0.3)->secondaryAddress(),
            'city' => $location['city'],
            'state' => $location['state'],
            'postal_code' => $location['zip'],
            'country' => 'USA',
            'contact_name' => $this->faker->optional(0.7)->name(),
            'contact_phone' => $this->faker->optional(0.7)->phoneNumber(),
            'contact_email' => $this->faker->optional(0.5)->email(),
            'delivery_notes' => $this->faker->optional(0.4)->sentence(),
            'google_map_link' => null,
        ];
    }

    public function corporate(): static
    {
        return $this->state(fn (array $attributes) => [
            'address_type' => ClientAddress::TYPE_CORPORATE,
            'label' => $this->faker->randomElement(['Corporate Office', 'Headquarters', 'Main Office']),
        ]);
    }

    public function shipping(): static
    {
        return $this->state(fn (array $attributes) => [
            'address_type' => ClientAddress::TYPE_SHIPPING,
            'label' => $this->faker->randomElement(['Main Warehouse', 'Distribution Center', 'Store Location', 'Receiving Dock']),
            'delivery_notes' => $this->faker->randomElement([
                'Deliver to back entrance.',
                'Call 30 minutes before arrival.',
                'Use loading dock on south side.',
                'Check in at guard station.',
                'Ring bell for receiving department.',
            ]),
        ]);
    }

    public function billing(): static
    {
        return $this->state(fn (array $attributes) => [
            'address_type' => ClientAddress::TYPE_BILLING,
            'label' => $this->faker->randomElement(['Accounts Payable', 'Billing Department', 'AP Dept']),
            'contact_email' => $this->faker->companyEmail(),
        ]);
    }

    public function primary(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_primary' => true,
        ]);
    }

    public function fake(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_fake' => true,
        ]);
    }
}
