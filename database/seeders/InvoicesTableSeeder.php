<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class InvoicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Invoice::class, 1000)->create()
            ->each(function ($invoice) {
                $faker = Faker::create();
                $n = $faker->numberBetween(1, 15);
                $items = factory(\App\Models\Item::class, $n)->create();
                $invoice->items()->saveMany($items);
            });


    }
}
