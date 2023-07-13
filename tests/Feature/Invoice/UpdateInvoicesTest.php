<?php

use App\Models\City;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\User;
use App\Models\Vat;
use Database\Seeders\TestSeeder;

test('invoices update action is not accessible if not connected', function () {
    $this->seed(TestSeeder::class);
    $response = $this->put(route('invoice_update', [
        'invoice' => 1,
    ]));

    $response->assertStatus(302);
    $response->assertRedirect(route('login'));

});

test('invoices update action gets error if owned by other user', function () {
    $this->seed(TestSeeder::class);

    $user = User::all()->first();
    $otherUser = User::all()->last();
    $invoice = Invoice::where('user_id', $otherUser->id)->first();

    $response = $this->actingAs($user)->put(route('invoice_update', [
        'invoice' => $invoice->id
    ]),
        [
            'items' => [
                [
                    "description" => $invoice->items[0]->description,
                    "price" => $invoice->items[0]->price,
                    "qty" => $invoice->items[0]->qty,
                    "vat_id" => $invoice->items[0]->vat_id,
                    "discount" => $invoice->items[0]->discount,
                ]
            ]
        ]);
    $response->assertStatus(302);
    $response->assertSessionHasErrors();

});

test('invoices update action gets error if wrong id is given', function () {
    $this->seed(TestSeeder::class);

    $user = User::all()->random();
    $invoice = Invoice::where('user_id', $user->id)->first();

    $response = $this->actingAs($user)->put(route('invoice_update', [
        'invoice' => 9999
    ]));

    $response->assertStatus(404);

});

test('invoices update action return error if required field missing', function () {
    $this->seed(TestSeeder::class);

    $user = User::all()->random();
    $invoice = Invoice::where('user_id', $user->id)->first();

    $response = $this->actingAs($user)->put(route('invoice_update', [
        'invoice' => $invoice->id
    ]),
        [
            'items' => [
                [
                    "description" => $invoice->items[0]->description,
                    // no price
                    "qty" => $invoice->items[0]->qty,
                    "vat_id" => $invoice->items[0]->vat_id,
                    "discount" => $invoice->items[0]->discount,
                ]
            ]
        ]);

    $response->assertStatus(302);
    $response->assertSessionHasErrors();
});

test('invoices update action gets error if submit form with wrong item id', function () {
    $this->seed(TestSeeder::class);

    $user = User::all()->random();
    $invoice = Invoice::where('user_id', $user->id)->first();

    $response = $this->actingAs($user)->put(route('invoice_update', [
        'invoice' => $invoice->id
    ]),
        [
            'items' => [
                [
                    "id" => 999,
                    "description" => $invoice->items[0]->description,
                    "price" => $invoice->items[0]->price,
                    "qty" => $invoice->items[0]->qty,
                    "vat_id" => $invoice->items[0]->vat_id,
                    "discount" => $invoice->items[0]->discount,
                ]
            ]
        ]);
    $response->assertStatus(302);
    $response->assertRedirect(route('invoices_list'));
});

test('invoices update action works  if submit form with no change ', function () {
    $this->seed(TestSeeder::class);

    $user = User::all()->random();
    $invoice = Invoice::where('user_id', $user->id)->first();

    $response = $this->actingAs($user)->put(route('invoice_update', [
        'invoice' => $invoice->id
    ]),
        [
            'items' => [
                [
                    "id" => $invoice->items[0]->id,
                    "description" => $invoice->items[0]->description,
                    "price" => $invoice->items[0]->price,
                    "qty" => $invoice->items[0]->qty,
                    "vat_id" => $invoice->items[0]->vat_id,
                    "discount" => $invoice->items[0]->discount,
                ]
            ]
        ]);
    $response->assertStatus(302);
    $response->assertRedirect(route('invoices_list'));
});


test('invoices update action update item when submit form', function () {
    $this->seed(TestSeeder::class);

    $user = User::all()->random();
    $invoice = Invoice::where('user_id', $user->id)->first();

    $referenceItem = $invoice->items[0];
    $referenceId = $referenceItem->id;
    $referenceDescription = 'new description for test';
    $referencePrice = 100;
    $referenceQty = 2;
    $referenceVat_id = 1;
    $referenceDiscount = 10;
    $vat_rate = Vat::where('id', $referenceVat_id)->first()->rate;
    $referenceTotal = ($referencePrice * $referenceQty - $referenceDiscount) * (1 + $vat_rate);

    $response = $this->actingAs($user)->put(route('invoice_update', [
        'invoice' => $invoice->id
    ]),
        [
            'items' => [
                [
                    "id" => $referenceId,
                    "description" => $referenceDescription,
                    "price" => $referencePrice,
                    "qty" => $referenceQty,
                    "vat_id" => $referenceVat_id,
                    "discount" => $referenceDiscount,
                ]
            ]
        ]);

    $response = $this->actingAs($user)->get(route('invoice_show', [
        'invoice' => $invoice->id
    ]));

    $response->assertStatus(200);
    $response->assertSee($referenceDescription);
    $response->assertSee($referencePrice);
    $response->assertSee($referenceQty);
    $response->assertSee($referenceTotal);
});

test('invoices update action works if submit form with new item', function () {
    $this->seed(TestSeeder::class);

    $user = User::all()->random();
    $invoice = Invoice::where('user_id', $user->id)->first();

    $response = $this->actingAs($user)->put(route('invoice_update', [
        'invoice' => $invoice->id
    ]),
        [
            'items' => [
                [
                    "description" => $invoice->items[0]->description,
                    "price" => $invoice->items[0]->price,
                    "qty" => $invoice->items[0]->qty,
                    "vat_id" => $invoice->items[0]->vat_id,
                    "discount" => $invoice->items[0]->discount,
                ]
            ]
        ]);
    $response->assertStatus(302);
    $response->assertRedirect(route('invoices_list'));
});

