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

/* Invoices */;

/* Users's invoices */
Route::get('/invoices', 'Invoice\InvoiceController@index')->name('invoices_list');
Route::get('/invoice/show/{id}', 'Invoice\InvoiceController@show')->name('invoice_show')->middleware('owned_invoice');
Route::get('/invoice/add/{id?}', 'Invoice\InvoiceController@create')->name('invoice_create');
Route::post('/invoice/store', 'Invoice\InvoiceController@store')->name('invoice_store');
Route::get('/invoice/edit/{id}', 'Invoice\InvoiceController@edit')->name('invoice_edit')->middleware('owned_invoice');
Route::put('/invoices/update', 'Invoice\InvoiceController@update')->name('invoice_update');
Route::get('/invoice/delete/{id}', 'Invoice\InvoiceController@delete')->name('invoice_delete')->middleware('owned_invoice');
Route::post('/invoice/remove', 'Invoice\InvoiceController@remove')->name('invoice_remove');