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

Route::prefix('invoicetemplate')->group(function() {
    Route::resource('/invoice-templates', 'InvoiceTemplateController');
    Route::resource('/service-bank', 'ServiceTemplateController'); 
    Route::get('/invoice-template-default/{id}', 'InvoiceTemplateController@setDefault')->name('invoice-templates.setDefault');
});