<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

Route::get('/test', [Controllers\TestController::class, 'test']
    )->name('test');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


// Not Confirmed
/** Guest Routes **/
Route::get('/searching', 'SiteController@searching')->name('site.search');
Route::resource('/email-templates', 'UserEmailTemplatesController');
Route::resource('/invoice-templates', 'UserInvoiceTemplatesController');
Route::resource('/packinglist-templates', 'UserPacklistTemplatesController')->middleware('auth');
Route::get('/payment-history', function () {return view('template.gold.dhl.payment-history.index');})->name('payment.history');

//////
Route::view('dashboard','layouts/dashboard');
Route::view('header','layouts/header');
Route::view('footer','layouts/footer');
// Route::view('dashboard','layouts/dashboard');

//Product Route
Route::view('AddProduct','layouts/Product/AddProduct');
Route::view('ProductList','layouts/Product/ProductList');
Route::view('UpdateProduct','layouts/Product/UpdateProduct');


















