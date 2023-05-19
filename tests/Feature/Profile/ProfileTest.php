<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Database\Seeders\TestSeeder;
use Illuminate\Foundation\Testing\TestCase ;


test('profile screen is redirected to login if not connected', function () {
    $this->seed(TestSeeder::class);

    $response = $this->get('/profile');

    $response->assertStatus(302);
    $response->assertRedirect(route('login'));
});

test('profile screen is rendered if user is connected', function () {
    $this->seed(TestSeeder::class);

    $user = User::all()->random();
    $response = $this->actingAs($user)
        ->get('/profile');
    $response->assertStatus(200);
});
