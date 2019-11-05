<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Client;
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

$factory->define(Client::class, function (Faker $faker) {
    return [
        'company' => $faker->company,
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'street' => $faker->streetAddress,
        'nr' => $faker->numberBetween(1, 100),
        'phone' => $faker->phoneNumber,
        'email' => $faker->email,
        'vat' => $faker->vat,
        'city_id' => $faker->numberBetween(1, 1000)
    ];
});
