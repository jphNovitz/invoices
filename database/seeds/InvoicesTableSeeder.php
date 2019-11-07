<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class InvoicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Invoice::class, 1000)->create()
            ->each(function ($invoice) {
                $faker = Faker::create();
                $n = $faker->numberBetween(1, 15);
                echo $n.' ';
              $items = factory(App\Item::class, $n )->create();
                $invoice->items()->saveMany($items);
        })
        ;



    }
}
