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

//
//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/logout', 'Auth\LogoutController')->middleware('auth');
Route::get('/', 'HomeController@index')->name('home');

/* user  */
Route::get('/user', 'User\UserController@index')->name('user_home');
Route::get('/user/update', 'User\UserController@update')->name('user_update');
Route::post('/user/store', 'User\UserController@store')->name('user_store');

/* Clients */

Route::prefix('client')->group(function () {
    Route::get('/', 'Client\ClientController@index')->name('clients_list');
    Route::get('/findadd', 'Client\ClientController@findClientToAdd')->name('clients_search_create'); /*Find Client to add*/
    Route::get('/add/{id}', 'Client\ClientController@add')->name('client_add'); /*Add found client with id*/
    Route::get('/create', 'Client\ClientController@create')->name('client_create');
    Route::post('/store', 'Client\ClientController@store')->name('client_store');
    Route::get('/update/{client}', 'Client\ClientController@edit')->name('client_update');
    Route::put('/save', 'Client\ClientController@update')->name('client_save');
    Route::get('/delete/{client}', function (App\Client $client) {
        return view('Client.client-delete', ['client' => $client]);
    })->name('client_delete');
    Route::delete('/delete/{client}', 'Client\ClientController@delete')->name('client_remove');
    Route::get('/{client}', 'Client\ClientController@show')->name('client_show');

    Route::get('/api/client/{client}', 'Client\ApiClientController@show')->name('api_client_infos');/* Invoices */;
});

/* Users's invoices */
Route::prefix('invoice')->group(function () {
    Route::get('/', 'Invoice\InvoiceController@index')->name('invoices_list');
    Route::get('/show/{id}', 'Invoice\InvoiceController@show')->name('invoice_show')->middleware('owned_invoice');
    Route::get('/add/{id?}', 'Invoice\InvoiceController@create')->name('invoice_create');
    Route::post('/store', 'Invoice\InvoiceController@store')->name('invoice_store');
    Route::get('/edit/{id}', 'Invoice\InvoiceController@edit')->name('invoice_edit')->middleware('owned_invoice');
    Route::put('/update', 'Invoice\InvoiceController@update')->name('invoice_update');
    Route::get('/delete/{id}', 'Invoice\InvoiceController@delete')->name('invoice_delete')->middleware('owned_invoice');
    Route::post('/remove', 'Invoice\InvoiceController@remove')->name('invoice_remove');
    Route::get('/generate-pdf/{id}', 'Invoice\PDFController@generatePDF')->name('invoice_generate_pdf');
    Route::get('/send-pdf/{id}','Invoice\PDFController@sendPDF')->name('invoice_send_pdf');

});
