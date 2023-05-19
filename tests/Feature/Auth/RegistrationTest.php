<?php

use App\Models\City;
use Database\Seeders\TestSeeder;
use Illuminate\Support\Str;

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $this->seed(TestSeeder::class);
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'company' => 'Lorem Company Test',
        'firstname' => 'Lorem ',
        'lastname' => 'Ipsum',
        'street' => 'Street Test',
        'nr' => '1',
        'phone' => '555 1234',
        'vat' => '1234567890',
        'city_id' => City::all()->random()->id,
        'remember_token' => Str::random(10),
        'prefix' => 'test',
        'first_id' => '1',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('home'));
});
