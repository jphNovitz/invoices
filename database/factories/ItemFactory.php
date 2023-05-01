<?php

namespace Database\factories;


use App\Models\Vat;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Item;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'description' => $this->faker->text(200),
            'price' => $this->faker->numberBetween(1, 100),
            'qty' => $this->faker->numberBetween(1, 10),
            'discount' => $this->faker->numberBetween(0, 5),
            'vat_id' => Vat::all()->random()
        ];
    }
}
