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
        User::factory(10)->create();
        Client::factory(1000)->create();
        $this->call(VatTableSeeder::class);
        Item::factory(1000)->create();
        Invoice::factory(100)
            ->create()
            ->each(function (Invoice $invoice) {
                $invoice->items()
                    ->attach(
                        Item::all()->random()->id
                    );
            });
    }
}
