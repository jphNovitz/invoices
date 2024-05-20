<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Database\Seeders\TestSeeder;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Http\Request;


test('profile delete screen is redirected to login if not connected', function () {
    $response = $this->get(route('user_delete'));

    $response->assertStatus(302);
    $response->assertRedirect(route('login'));
});

test('profile delete screen is rendered if user is connected', function () {
    $this->seed(TestSeeder::class);

    $user = User::all()->random();
    $response = $this->actingAs($user)
        ->get(route('user_delete'));
    $response->assertStatus(200);
});

test('user profile remove_isredirected_if_wrong_user', function () {
    $this->seed(TestSeeder::class);
    $user = User::all()->first();
    $other_user = User::all()->last();

    $response = $this->actingAs($other_user)
        ->from(route('user_delete'))
        ->delete(route('user_remove', ['user'=> $user->id]));
//dd($response);
    $response->assertStatus(302);
    $response->assertSessionHasErrors();
});

test('user profile is deleted', function () {
    $this->seed(TestSeeder::class);
    $user = User::all()->random();

    $response = $this->actingAs($user)
        ->from(route('user_delete'))
        ->delete(route('user_remove', ['user'=> $user->id]));

    $response->assertRedirect(route('welcome'));
    $this->assertDatabaseMissing('users', [
        'id' => $user->id,
    ]);
});


test('user is redirected  without delete if decline is selected', function () {
    $this->seed(TestSeeder::class);
    $user = User::all()->random();

    $response = $this->actingAs($user)
        ->from(route('user_delete'))
        ->delete(route('user_remove', [
            'user'=> $user->id,
            '_decline' => 'non'
        ]));

    $response->assertRedirect(route('user_home'));


    $response->assertRedirect(route('user_home'));
    $this->assertDatabaseHas('users', [
        'id' => $user->id,
    ]);
});
