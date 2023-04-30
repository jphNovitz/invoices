<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\User::class, 10)->create()
            ->each(function ($user) {
                $faker = Faker::create();
                $n = $faker->numberBetween(1, 15);
                $clients = factory(\App\Models\Client::class, $n)->create();
                $user->clients()->saveMany($clients);
            });
        $firstUser = \App\Models\User::all()->first();
        $firstUser->email = "hello@pixelservices.be";
        $firstUser->save();
    }
}
