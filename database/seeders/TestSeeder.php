<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::factory(3)->create();
        User::factory(2)->create();
        Client::factory(2)->create();
        $users = User::all();
        Client::all()->each(function ($client) use ($users) {
            $client->users()->attach(
                $users->random()->pluck('id')->toArray()
            );
        });
    }
}
