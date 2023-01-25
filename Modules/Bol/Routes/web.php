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

Route::prefix('bol')->group(function() {
    Route::get('/', 'BolController@index');

    Route::get('/all_orders', 'OrderController@allOrders')
        ->middleware('auth');
    Route::get('/apidata/{site}', [
            'uses' => 'BolRetailerController@getOpenOrders', 
            'as' => 'apidata'
        ])
        ->middleware('auth');
    Route::get('/fetched/labels/{id}', 'OrderController@fetchedLabels')->middleware('auth');
    Route::get('/invoice', 'OrderController@invoice2');
    Route::post('/check_invoice2/', 'OrderController@check_invoice2')->middleware('auth');

    // Download PDF
    Route::get('/download-packinglist-pdf/{id}', 'UserPacklistTemplatesController@downloadInvoice')->middleware('auth');
    Route::get('/download-invoice-pdf/{id}', 'UserInvoiceTemplatesController@downloadInvoice');
    Route::post('/invoice_submit2', 'OrderController@invoice_submit2');
    Route::get('/download', function(){
        return view('bol::download');
    })->middleware('auth');
    Route::post('/label_download', 'OrderController@downloadLabel');
    Route::get('/account-report', 'NotificationController@accountReport');
    Route::get('/orders_emails/{id}', 'OrderController@ordersEmails')->middleware('auth');





    Route::get('/orders/{id}', 'OrderController@orders')->middleware('auth');    
    Route::post('/orders_emails_send', 'OrderController@ordersEmailsSend')->middleware('auth');
    Route::post('/fetch/{id}', 'OrderController@fetch')->middleware('auth');
    Route::get('/fetch/select/{id}', 'OrderController@fetchSelect')->middleware('auth');
    Route::post('/fetch/select/next', 'OrderController@fetchSelectNext')->middleware('auth');
    
    Route::post('/update_orders', 'OrderController@updateOrders')->middleware('auth');
    Route::get('/packing_list/{site}/{id}', 'OrderController@packing_list')->middleware('auth');
    Route::get('/dhl_csv/{site}/{id}', 'OrderController@dhl_csv')->middleware('auth');
    Route::get('/delete/{site}/{id}', 'OrderController@delete')->middleware('auth');
    Route::get('/create_invoice/{site}/{id}', 'OrderController@create_invoice')->middleware('auth');
    Route::post('/check_invoice/', 'OrderController@check_invoice')->middleware('auth');    
    Route::post('/check_in1/{id}', 'OrderController@check_in1')->middleware('auth');
    Route::post('/print_invoice/', 'OrderController@print_invoice')->middleware('auth');

    Route::get('/invoice2', function () {return view('template/gold/dhl/bol_invoice');});
    Route::post('/invoice_submit', 'OrderController@invoice_submit');
    
    
    Route::get('/create_invoice_2/{order_id}', 'OrderController@create_invoice_2');
    Route::get('/create_invoice_3/{order_id}', 'OrderController@create_invoice_3');
    Route::get('/create_packing_list/{order_id}', 'OrderController@create_packing_list');
    Route::get('/download_packing_list/{id}', 'OrderController@download_packing_list')->name('bol.packlist');

    

    Route::get('/bolexport/{recid}',[
        "uses" => 'CustomerController@getExport',
        "as" => 'bolexport'])->middleware('auth');


    // Not confirmed
    Route::get('/Exportqty/{recid}',[
        "uses" => 'ExportqtyController@getExport',
        "as" => 'Exportqty'])->middleware('auth');
    Route::get('/Exportcsv/{recid}',[
        "uses" => 'CsvexportController@getExport',
        "as" => 'Exportcsv'])->middleware('auth');

    /** Download PDF **/
    Route::get('/download-pdf/{type}/order/{id}', 'OrderController@labelDownload');
    
    
    Route::get('/wallet-invoice/{id}', 'MollieController@walletInvoice')->middleware('auth');
    Route::get('/download-custom-label','CustomOrderController@downloadCustomLabel')->middleware('auth');
    Route::get('/unikoop/payment-invoice/{id}','UnikoopController@paymentInvoice');
});
