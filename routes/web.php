<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\LoanController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


Route::middleware(['auth'])->prefix('/')->group(function () {
    //Client loans routes
    Route::get('/loans', 'LoanController@index')->name('loans-index');
    Route::get('/loans/create/{id}', 'LoanController@create')->name('loans-create');
    Route::post('/loans/store', 'LoanController@store')->name('loan-store');
    Route::get('/loans/edit', 'ClientController@edit')->name('loans-edit');
    Route::get('/loans/update/{id}', 'ClientController@update')->name('loans-update');
    Route::get('/loans/delete/{id}', 'LoanController@delete')->name('loans-destroy');

    //clients
    Route::get('/clients/new', 'ClientController@create')->name('clients-new');
    Route::post('/clients/store', 'ClientController@store')->name('client-store');
    Route::get('/clients/existing', 'ClientController@index')->name('clients-existing');
    // Route::get('/clients/new', 'ClientController@index')->name('clients-new');


    //payments
    Route::get('/payments', 'PaymentController@index')->name('payments-index');
    Route::get('/payments/{client}/{loan}', 'PaymentController@create')->name('make-payment');
    Route::post('/payment/store', 'PaymentController@store')->name('payment-store');
});
