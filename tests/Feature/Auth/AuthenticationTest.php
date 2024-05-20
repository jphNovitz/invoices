<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Database\Seeders\TestSeeder;
use Illuminate\Foundation\Testing\TestCase ;


test('login screen can be rendered', function () {
    $this->withoutExceptionHandling();

    $response = $this->get('/login');

    $response->assertStatus(200);
});

test('users can authenticate using the login screen', function () {
    $this->seed(TestSeeder::class);
    $user = User::all()->random();

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('home'));
});

test('users can not authenticate with invalid password', function () {
    $this->seed(TestSeeder::class);
    $user = User::all()->random();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});


test('users can logout', function () {
    $this->seed(TestSeeder::class);
    $user = User::all()->random();


    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);
    $this->assertAuthenticated();

    $response = $this->get('/logout');
    $this->assertNull(auth()->user());
    $this->assertGuest();
//die;
//    $this->assertAuthenticated();
//    $response->assertRedirect(route('home'));
});
