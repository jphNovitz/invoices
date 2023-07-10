<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        City::factory(100)->create();
        Client::factory(10)->create();
//        User::factory(10)->create();

        $users = User::all();
        Client::all()->each(function ($client) use ($users) {
            $client->users()->attach(
                User::factory(10)->create()
//                $users->random(rand(1, 3))->pluck('id')->toArray()

            );
        });
        $this->call(VatTableSeeder::class);
        Item::factory(4000)->create();
        Invoice::factory(500)
            ->create()
            ->each(function (Invoice $invoice) {
                $invoice->items()
                    ->attach(
                        Item::factory(3)->create()
//                        Item::all()->random()->id
                    );
            });
    }
}
