<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition()
    {
        return [

            'team_id' => Team::exists()
                ? Team::inRandomOrder()->value('id')
                : Team::factory()->create()->id,
            'name' => $this->faker->company,
            'company_name' => $this->faker->company,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'published' => $this->faker->boolean,

        ];
    }
}
