<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Invoice;

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

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invoice::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $count_clients = \App\Models\Client::count();
        $count_users = \App\Models\User::count();
        return [
            'reference' => $this->faker->text(5) . '-' . $this->faker->numberBetween(1, 5),
            'user_id' => $this->faker->numberBetween(1, $count_users),
            'client_id' => $this->faker->numberBetween(1, $count_clients),
        ];
    }
}
