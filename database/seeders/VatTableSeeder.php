<?php

namespace Database\Seeders;

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $rates = [6, 12, 21];

        for ($i=0 ; $i <= 2 ; $i++){
            DB::table('vat')->insert([
                'rate' => $rates[$i]/100,
                'name' => 'taux '. $rates[$i] .' %',
                'description' => $faker->sentence(5, true),
            ]);
        }
    }
}
