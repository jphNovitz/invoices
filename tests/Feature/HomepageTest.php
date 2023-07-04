<?php

use App\Models\City;
use App\Models\Client;
use App\Models\User;
use Database\Seeders\TestSeeder;
use Illuminate\Support\Facades\Session;

test('homepage is accessible', function () {
    $response = $this->get(route('welcome'));

    $response->assertStatus(200);
});
