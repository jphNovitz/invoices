<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 10)->create()
            ->each(function ($user) {
                $faker = Faker::create();
                $n = $faker->numberBetween(1, 15);
                $clients = factory(App\Client::class, $n)->create();
                $user->clients()->saveMany($clients);
            });
    }
}
