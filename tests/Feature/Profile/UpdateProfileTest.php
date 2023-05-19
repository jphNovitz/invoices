<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Database\Seeders\TestSeeder;
use Illuminate\Foundation\Testing\TestCase ;
use Illuminate\Http\Request;


test('profile update screen is redirected to login if not connected', function () {
    $response = $this->get(route('user_update'));

    $response->assertStatus(302);
    $response->assertRedirect(route('login'));
});

test('profile update screen is rendered if user is connected', function () {
    $this->seed(TestSeeder::class);

    $user = User::all()->random();
    $response = $this->actingAs($user)
        ->get(route('user_update'));
    $response->assertStatus(200);
});

test('profile update screen can not  update if all field not given', function () {
    $this->seed(TestSeeder::class);
    $user = User::all()->random();

    $response = $this->actingAs($user)
        ->from(route('user_update'))
        ->put(route('user_store', [
            'name' => 'new name Lorem'
        ]));
    $response
    ->assertStatus(500)
    ;
});


test('profile update screen can update name', function () {
    $this->seed(TestSeeder::class);
    $user = User::all()->random();


    $datas = $user->toArray();

    $datas['name'] = 'new name Lorem';

    $response = $this->actingAs($user)
        ->from(route('user_update'))
        ->put(route('user_store', $datas));
    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('user_home'));
    ;
});
