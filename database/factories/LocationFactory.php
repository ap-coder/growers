<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\Client;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    protected $model = Location::class;

    public function definition()
    {
        return [
            'client_id' => Client::exists()
                ? Client::inRandomOrder()->value('id')
                : Client::factory()->create()->id,
            'team_id' => Team::pluck('id')->random(),
            'published' => $this->faker->boolean,
            'nickname' => $this->faker->word,
            'address' => $this->faker->address,
            'address_2' => $this->faker->secondaryAddress,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'zipcode' => $this->faker->postcode,
            'phone' => $this->faker->phoneNumber,
            'phone_2' => $this->faker->phoneNumber,
            'full_address' => $this->faker->address,
            'slug' => $this->faker->slug,
            'country' => $this->faker->country,
            'google_map_url' => $this->faker->url,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
//            'created_at' => \Illuminate\Support\Facades\Date::now(),
//            'updated_at' => \Illuminate\Support\Facades\Date::now(),
        ];
    }
}
