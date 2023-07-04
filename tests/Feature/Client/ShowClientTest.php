<?php

use App\Models\City;
use App\Models\Client;
use App\Models\User;
use Database\Seeders\TestSeeder;

test('show client screen is not accessible if not connected', function () {
    $this->seed(TestSeeder::class);
    $client = Client::all()->random()->id;
    $response = $this->get(route('client_show', [
        "client" => $client
    ]));

    $response->assertStatus(302);
    $response->assertRedirect(route('login'));

});


test('show client screen is accessible if connected', function () {
    $this->seed(TestSeeder::class);
    $user = User::all()->random();
    $client = $user->clients()->first();

    $response = $this->actingAs($user)
        ->get(route('client_show', [
            "client" => $client->id
        ]));

    $response->assertStatus(200);

});
