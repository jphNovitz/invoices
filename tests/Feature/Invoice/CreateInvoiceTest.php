<?php

use App\Models\City;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\User;
use Database\Seeders\TestSeeder;

test('invoices create screen is not accessible if not connected', function () {
    $this->seed(TestSeeder::class);
    $response = $this->get(route('invoice_create'));

    $response->assertStatus(302);
    $response->assertRedirect(route('login'));

});

test('invoices create screen is accessible if logged in', function () {
    $this->seed(TestSeeder::class);
    $user = User::all()->random();

    $response = $this->actingAs($user)->get(route('invoice_create'));

    $response->assertStatus(200);
    $response->assertSee('Nouvelle facture');
});

