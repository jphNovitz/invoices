<?php

use App\Models\City;
use App\Models\Client;
use App\Models\User;
use Database\Seeders\TestSeeder;
use Illuminate\Support\Facades\Session;

test('client update  screen is not accessible if not connected', function () {
    $this->seed(TestSeeder::class);
    $user = User::all()->random();
    $client = $user->clients->first();

    $response = $this->get(route('client_update', [
        'client' => $client->id
    ]));

    $response->assertStatus(302);
    $response->assertRedirect(route('login'));

});

test('client update screen  gets error if  connected but no client  given', function () {

    $this->seed(TestSeeder::class);
    $user = User::all()->random();

    $response = $this->actingAs($user)
        ->get(route('client_update'));

//    $response->assertStatus(404);
    $response->assertSessionHasErrors();

});

test('client update screen  is accessible if logged in and client id given', function () {
    $this->seed(TestSeeder::class);
    $user = User::all()->random();
    $client = $user->clients->first();

    $response = $this->actingAs($user)
        ->get(route('client_update', [
            'client' => $client->id
        ]));

    $response->assertStatus(200);
});


test('Client update action gets error if fied is missing when submit form', function () {
    $this->seed(TestSeeder::class);
    $user = User::all()->random();
    $client = $user->clients->first();

    $client->firstname = "";

    $response = $this->actingAs($user)
        ->put(route('client_save', [
            'client' => $client->id,
            "firstname" => "",
            "lastname" => $client->lastname,
            "company" => $client->company,
            "vat" => $client->vat,
            "street" => $client->street,
            "nr" => $client->nr,
            "phone" => $client->phone,
            "email" => $client->email,
            "city_id" => 1
        ]));

    $response->assertStatus(302);
    $response->assertSessionHasErrors();

});

test('Client is updated if all fields are given in submit form', function () {
    $this->seed(TestSeeder::class);
    $user = User::all()->random();
    $client = $user->clients->first();

    $client->firstname = "My new name";

    $response = $this->actingAs($user)
        ->put(route('client_save', [
            'id' => $client->id,
            "firstname" => $client->firstname,
            "lastname" => $client->lastname,
            "company" => $client->company,
            "vat" => $client->vat,
            "street" => $client->street,
            "nr" => $client->nr,
            "phone" => $client->phone,
            "email" => $client->email,
            "city_id" => 1
        ]));

    $response->assertRedirect(route('clients_list'));

    $response = $this->actingAs($user)
        ->get(route('clients_list'));
        $response->assertSee("My new name");

});
