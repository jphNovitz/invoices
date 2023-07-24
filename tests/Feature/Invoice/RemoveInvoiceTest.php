<?php


use App\Models\User;
use Database\Seeders\TestSeeder;

test('invoice remove action is redirected if decline is selected', function () {
    $this->seed(TestSeeder::class);
    $user = User::all()->random();
    $invoice = $user->invoices->random();

    $response = $this->actingAs($user)
        ->delete(route('invoice_remove', [
            'invoice' => $invoice->id,
            '_decline' => 'No'
        ]));

    $response->assertStatus(302);
    $response->assertRedirect(route('invoices_list'));
    $response->assertSessionHasNoErrors();

});

test('invoice remove action is redirected to invoice list with no errors if accept is selected', function () {
    $this->seed(TestSeeder::class);
    $user = User::all()->random();
    $invoice = $user->invoices->random();

    $response = $this->actingAs($user)
        ->delete(route('invoice_remove', [
            'invoice' => $invoice->id,
            '_accept' => 'Yes'
        ]));

    $response->assertStatus(302);
    $response->assertRedirect(route('invoices_list'));
    $response->assertSessionHasNoErrors();

});



