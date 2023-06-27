<?php

use App\Models\User;
use Database\Seeders\TestSeeder;

test('create client screen is not accessible if not connected', function () {
    $response = $this->get(route('client_create'));

    $response->assertStatus(302);
    $response->assertRedirect(route('login'));

});

test('create client screen is accessible if connected', function () {
    $this->seed(TestSeeder::class);
    $user = User::all()->random();

    $response = $this->actingAs($user)
        ->get(route('client_create'));

    $response->assertStatus(200);

});
test('', function () {
    $this->seed(TestSeeder::class);
    $response = $this->get();

});