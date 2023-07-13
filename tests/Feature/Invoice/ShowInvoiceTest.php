<?php

use App\Models\City;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\User;
use Database\Seeders\TestSeeder;

test('invoices show screen is not accessible if not connected', function () {
    $this->seed(TestSeeder::class);
    $response = $this->get(route('invoice_show', [
        'invoice' => 1
    ]));

    $response->assertStatus(302);
    $response->assertRedirect(route('login'));

});

test('invoices show screen is accessible if logged in', function () {
    $this->seed(TestSeeder::class);

    $user = User::all()->random();
    $invoice = Invoice::where('user_id', $user->id)->first();

    $response = $this->actingAs($user)->get(route('invoice_show', [
        'invoice' => $invoice->id
    ]));

    $response->assertStatus(200);
    $response->assertSee('Détails de la facture:');
    $response->assertSee($invoice->reference);
    $response->assertSee($invoice->client->company);
});

test('invoices show screen gets error if owned by other user', function () {
    $this->seed(TestSeeder::class);

    $user = User::all()->first();
    $otherUser = User::all()->last();
    $invoice = Invoice::where('user_id', $otherUser->id)->first();

    $response = $this->actingAs($user)->get(route('invoice_show', [
        'invoice' => $invoice->id
    ]));

    $response->assertStatus(302);
    $response->assertSessionHasErrors();

});

test('invoices show screen gets error if wrong id is given', function () {
    $this->seed(TestSeeder::class);

    $user = User::all()->random();
    $invoice = Invoice::where('user_id', $user->id)->first();

    $response = $this->actingAs($user)->get(route('invoice_show', [
        'invoice' => 9999
    ]));

    $response->assertStatus(404);

});