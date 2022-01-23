<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Invoice;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(Invoice::class, function (Faker $faker) {

    $count_clients = App\Client::count();
    return [
        'reference' => $faker->text(5).'-'.$faker->numberBetween(1, 5),
        'user_id' => $faker->numberBetween(1, 10),
        'client_id' => $faker->numberBetween(1, $count_clients),
    ];
});
