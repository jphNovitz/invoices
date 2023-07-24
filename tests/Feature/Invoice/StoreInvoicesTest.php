<?php

use App\Models\City;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\User;
use App\Models\Vat;
use Database\Seeders\TestSeeder;

test('invoices store action is not accessible if not connected', function () {
    $this->seed(TestSeeder::class);
    $response = $this->post(route('invoice_store'));

    $response->assertStatus(302);
    $response->assertRedirect(route('login'));

});

test('invoices store action is accessible if connected and good payload submitted', function () {
    $this->seed(TestSeeder::class);

    $user = User::all()->first();
    $client = $user->clients->first();

    $referenceDescription = fake()->sentence(8);
    $referencePrice = fake()->numberBetween(1, 1000);
    $referenceQty = fake()->numberBetween(1,100);
    $referenceVat_id = fake()->numberBetween(1,3);
    $referenceDiscount = fake()->numberBetween(0, 50);

    $response = $this->actingAs($user)
        ->post(route('invoice_store'),
            [
                'client_id' => $client->id,
                'items' => [
                    [
                        "description" => $referenceDescription ,
                        "price" => $referencePrice,
                        "qty" => $referenceQty,
                        "vat_id" => $referenceVat_id,
                        "discount" => $referenceDiscount,
                    ]
                ]
            ]);

    $response->assertStatus(302);
    $response->assertRedirect(route('invoices_list'));

});

test('invoices store action works and new invoice is in list', function () {
    $this->seed(TestSeeder::class);

    $user = User::all()->first();
    $client = $user->clients->first();

    $referenceDescription = fake()->sentence(8);
    $referencePrice = fake()->numberBetween(1, 1000);
    $referenceQty = fake()->numberBetween(1,100);
    $referenceVat_id = fake()->numberBetween(1,3);
    $referenceDiscount = fake()->numberBetween(0, 50);
    $vat_rate = Vat::where('id', $referenceVat_id)->first()->rate;

    $referenceTotal = ($referencePrice * $referenceQty - $referenceDiscount) * (1 + $vat_rate);

    $this->actingAs($user)
        ->post(route('invoice_store'),
            [
                'client_id' => $client->id,
                'items' => [
                    [
                        "description" => $referenceDescription ,
                        "price" => $referencePrice,
                        "qty" => $referenceQty,
                        "vat_id" => $referenceVat_id,
                        "discount" => $referenceDiscount,
                    ]
                ]
            ]);

    $response = $this->actingAs($user)
        ->get(route('invoice_show', [
            "invoice" => Invoice::where('user_id', $user->id)->get()->last()
        ]));

    $response->assertStatus(200);
    $response->assertSee($referenceDescription);
    $response->assertSee($referenceTotal);

});