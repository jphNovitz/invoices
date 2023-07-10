<?php

use App\Models\City;
use App\Models\Client;
use App\Models\User;
use Database\Seeders\TestSeeder;
use Illuminate\Support\Facades\Session;

test('dashboard screen is not accessbile if not authenticated', function () {
    $response = $this->get(route('home'));

    $response->assertStatus(302);
    $response->assertRedirect(route('login'));

});

test('dashboard screen is if authenticated', function () {
    $this->seed(TestSeeder::class);
    $user = User::all()->random();

    $response = $this->actingAs($user)->get(route('home'));

    $response->assertStatus(200);

});

