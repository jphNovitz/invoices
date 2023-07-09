<?php

use App\Models\City;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\User;
use Database\Seeders\TestSeeder;

test('invoices index list  screen is not accessible if not connected', function () {
    $this->seed(TestSeeder::class);
    $response = $this->get(route('invoices_list'));

    $response->assertStatus(302);
    $response->assertRedirect(route('login'));

});


test('invoices index list screen is accessible if connected', function () {
    $this->seed(TestSeeder::class);
    $user = User::all()->random();

    $response = $this->actingAs($user)
        ->get(route('invoices_list'));

    $response->assertStatus(200);

});

test('invoices index list screen contains the page title', function () {
    $this->seed(TestSeeder::class);
    $user = User::all()->random();

    $response = $this->actingAs($user)
        ->get(route('invoices_list'));

    $response->assertSee('Liste de vos factures');

});

test('invoices index list screen contains an invoice reference', function () {
    $this->seed(TestSeeder::class);
    $user = User::all()->random();
    $invoice = Invoice::where('user_id', $user->id)->first();

    $response = $this->actingAs($user)
        ->get(route('invoices_list'));

    $response->assertSee($invoice->reference);

});
