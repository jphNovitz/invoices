<?php

use App\Models\City;
use App\Models\Client;
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

test('create client screen contains city', function () {
    $this->seed(TestSeeder::class);
    $user = User::all()->random();

    $city = City::first();

    $response = $this->actingAs($user)
        ->get(route('client_create'));

    $response->assertStatus(200);
    $response->assertSee($city->name);


});

test('store client action gets error if field is missing when submit form', function () {
    $this->seed(TestSeeder::class);
    $user = User::all()->random();

    $response = $this->actingAs($user)
        ->post(route('client_store', [
            "firstname" => "Lorem name",
            "lastname" => "Last Ipsum",
            "company" => "Fake Company",
            "vat" => "",
            "street" => "Street Lorem",
            "nr" => "1",
            "phone" => "55534343",
            "email" => "fake@email.com",
            "city_id" => "1"
        ]));

    $response->assertStatus(302);
});

test('store client action redirect to clients list after create', function () {
    $this->seed(TestSeeder::class);
    $user = User::all()->random();

    $response = $this->actingAs($user)
        ->post(route('client_store', [
            "firstname" => "Lorem name",
            "lastname" => "Last Ipsum",
            "company" => "Fake Company",
            "vat" => "123456789",
            "street" => "Street Lorem",
            "nr" => "1",
            "phone" => "55534343",
            "email" => "fake@email.com",
            "city_id" => "1"
        ]));

    $response->assertRedirect(route('clients_list'));

});

test('new client exists in database after create', function () {
    $this->seed(TestSeeder::class);
    $user = User::all()->random();

    $response = $this->actingAs($user)
        ->post(route('client_store', [
            "firstname" => "Lorem name",
            "lastname" => "Last Ipsum",
            "company" => "Fake Company",
            "vat" => "123456789",
            "street" => "Street Lorem",
            "nr" => "1",
            "phone" => "55534343",
            "email" => "fake@email.com",
            "city_id" => "1"
        ]));

    $client = Client::where("vat", "=", "123456789")->first();

    $this->assertNotNull($client);
    $this->assertEquals($client->firstname, "Lorem name");
});
