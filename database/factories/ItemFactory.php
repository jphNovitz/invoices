<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Item;
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

$factory->define(Item::class, function (Faker $faker) {
    return [
        'description' => $faker->text(200),
        'price' => $faker->numberBetween(1,100),
        'qty' => $faker->numberBetween(1,10),
        'discount' => $faker->numberBetween(0,5),
        'vat_id' => $faker->numberBetween(1,3)
    ];
});
