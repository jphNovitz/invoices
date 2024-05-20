<?php

use App\Models\Invoice;
use App\Models\User;
use Database\Seeders\TestSeeder;

test('login screen is redirected if already authenticated', function () {
    $this->seed(TestSeeder::class);

    $user = User::all()->first();

    $response = $this->actingAs($user)->get(route('login'));

    $response->assertStatus(302);
    $response->assertRedirect(route('home'));

});