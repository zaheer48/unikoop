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

Route::prefix('generateinvoice')->group(function() {
    Route::get('/', 'GenerateInvoiceController@index');
    Route::get('/get-invoice', 'GenerateInvoiceController@index')->name('get.invoice');
    Route::post('/invoice.check.order', 'GenerateInvoiceController@check_order')
            ->name('invoice.check.order');
    Route::get('/download-invoice-pdf/{id}', 'GenerateInvoiceController@downloadInvoice')
        ->name('invoice.download.pdf');
});
