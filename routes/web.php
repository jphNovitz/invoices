<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/* user  */
Route::get('/user', 'User\UserController@index')->name('user_home');
Route::get('/user/update', 'User\UserController@update')->name('user_update');
Route::post('/user/store', 'User\UserController@store')->name('user_store');

/* Client */
Route::get('/clients', 'Client\ClientController@index')->name('clients_home');
Route::get('/client/{client}', 'Client\ClientController@show')->name('client_card');
Route::get('/client/{client}/update', 'Client\ClientController@update')->name('client_update');
Route::get('/client/{client}/delete', function (App\Client $client){
    return view('Client.client-delete', ['client' => $client]);
})->name('client_delete');
Route::delete('/client/{client}/delete', 'Client\ClientController@delete')->name('client_remove');
Route::get('/clients/new', 'Client\ClientController@create')->name('clients_create');
Route::post(null, 'Client\ClientController@store')->name('client_store');
Route::put(null, 'Client\ClientController@save')->name('client_save');

Route::get('/api/client/{client}', 'Client\ApiClientController@show')->name('api_client_infos');

/* Invoices */
Route::get('/invoices/add/{new_client?}', 'Invoice\InvoiceController@create')->name('client_invoice_create');
Route::post('/invoices/add', 'Invoice\InvoiceController@store')->name('client_invoice_store');
Route::get('/invoices/{id}', 'Invoice\InvoiceController@show')->name('invoice_show')->middleware('owned_invoice');
Route::get('/invoices/{id}/delete', 'Invoice\InvoiceController@delete')->name('invoice_delete');
Route::get('/invoices/{id}/edit', 'Invoice\InvoiceController@edit')->name('invoice_edit');
Route::put('/invoices/update', 'Invoice\InvoiceController@update')->name('invoice_update');

/* Users's invoices */
Route::get('/invoices', 'Invoice\InvoiceController@index')->name('user_invoices_list');
//Route::get('client/{client}/invoices', 'Invoice\InvoiceController@index')->name('client_invoices_list');
//Route::get('client/{client}/invoice/{invoice}/card', 'Invoice\InvoiceController@card')->name('client_invoices_card');
//Route::get('client/{client}/invoice/{invoice}/delete', 'Invoice\InvoiceController@delete')->name('client_invoices_delete');