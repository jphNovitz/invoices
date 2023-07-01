<?php

use App\Models\City;
use App\Models\Client;
use App\Models\User;
use Database\Seeders\TestSeeder;
use Illuminate\Support\Facades\Session;

test('client delete screen is not accessible if not connected', function () {
    $response = $this->get(route('client_update', [
        'client' => 1
    ]));

    $response->assertStatus(302);
    $response->assertRedirect(route('login'));

});

test('client delete screen  gets error if  connected but no client id given', function () {
    $this->seed(TestSeeder::class);
    $user = User::all()->random();

    $response = $this->actingAs($user)
        ->get(route('client_update'));

    $response->assertStatus(302);
    $response->assertSessionHasErrors();

});

test('client delete screen  fails if client has invoices', function () {
    $this->seed(TestSeeder::class);
    $user = User::all()->random();
    $client = $user->clients->first();

    $response = $this->actingAs($user)
        ->get(route('client_delete', [
            'client' => $client->id
        ]));

    $response->assertStatus(302);
    $response->assertSessionHasErrors();
});

test('client delete screen  fails if client has multiple users', function () {
    $this->seed(TestSeeder::class);
    $user = User::all()->random();
    Client::factory(1)->create();
    Client::all()->last()->users()->attach($user->id);
    Client::all()->last()->users()->attach(User::all()->random()->id);
    $client = Client::all()->last();

    $response = $this->actingAs($user)
        ->get(route('client_delete', [
            'client' => $client->id
        ]));

    $response->assertStatus(302);
    $response->assertSessionHasErrors();
});

