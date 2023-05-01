<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'company' => $this->faker->company,
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'street' => $this->faker->streetAddress,
            'nr' => $this->faker->numberBetween(1, 100),
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'vat' => $this->faker->vat,
            'city_id' => City::all()->random()
        ];
    }
}
