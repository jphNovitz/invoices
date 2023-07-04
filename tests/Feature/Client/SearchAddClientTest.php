<?php

use App\Models\City;
use App\Models\Client;
use App\Models\User;
use Database\Seeders\TestSeeder;

test('search add client screen is not accessible if not connected', function () {
    $response = $this->get(route('clients_search_create'));

    $response->assertStatus(302);
    $response->assertRedirect(route('login'));

});


test('search add client screen is accessible if connected', function () {
    $this->seed(TestSeeder::class);
    $user = User::all()->random();

    $response = $this->actingAs($user)
        ->get(route('clients_search_create'));

    $response->assertStatus(200);

});

test('search add client screen contains random client', function () {
    $this->seed(TestSeeder::class);
    $user = User::all()->random();

    $client = Client::all()->random();

    $response = $this->actingAs($user)
        ->get(route('clients_search_create'));

    $response->assertStatus(200);
    $response->assertSee('Rechercher / Ajouter un client');
    $response->assertSee($client->name);


});

test('client add  action from search add  gets error if client id is not given', function () {
    $this->seed(TestSeeder::class);
    $user = User::all()->random();

    $response = $this->actingAs($user)
        ->get(route('client_add', [
            "id" => 99
        ]));
    $response->assertSessionHasErrors();
});

//test('client add  action from search add  gets error if given id client already in', function () {
//    $this->seed(TestSeeder::class);
//    $user = User::all()->random();
//    $id = $user->clients()->first()->id;
//
//    $response = $this->actingAs($user)
//        ->get(route('client_add', [
//            "id" => $id
//        ]));
//    $response->assertSessionHasErrors();
//});

test('client add  action from search add  works if not has client id given', function () {
    $this->seed(TestSeeder::class);
    $user = User::all()->random();
    Client::factory()->create();
    $id = Client::all()->last()->id;

    $response = $this->actingAs($user)
        ->get(route('client_add', [
            "id" => $id
        ]));
    $response->assertSessionHasNoErrors();
});