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
Route::group(['middleware' => ['auth'], 'prefix' => 'bol'], function() {
    Route::get('/', 'BolController@index')->name('bol');

    Route::get('/all_orders', 'OrderController@allOrders')->name('all.orders');
    Route::get('/orders/{id}', 'OrderController@orders')->name('bol.update');
    Route::get('/invoice', 'OrderController@invoice2')->name('invoice');
    Route::post('/check_invoice2/', 'OrderController@check_invoice2')->name('check.invoice2');
    Route::get('/download-invoice-pdf/{id}', 'UserInvoiceTemplatesController@downloadInvoice')->name('download.invoice.pdf');
    Route::get('/download-packinglist-pdf/{id}', 'UserPacklistTemplatesController@downloadInvoice')->name('download.packinglist.pdf');
    Route::get('/apidata/{site}', [
        'uses' => 'BolRetailerController@getOpenOrders',
        'as' => 'apidata'
    ]);
    Route::get('/fetched/labels/{id}', 'OrderController@fetchedLabels')->name('fetched.labels');
    Route::get('/bolexport/{recid}',[
        "uses" => 'CustomerController@getExport',
        "as" => 'bolexport'
    ]);
    Route::get('/Exportqty/{recid}',[
        "uses" => 'ExportqtyController@getExport',
        "as" => 'Exportqty'
    ]);
    Route::get('/dhl_csv/{site}/{id}', 'OrderController@dhl_csv');
    Route::get('/packing_list/{site}/{id}', 'OrderController@packing_list');
    Route::get('/orders_emails/{id}', 'OrderController@ordersEmails');
    Route::post('/orders_emails_send', 'OrderController@ordersEmailsSend');
    Route::get('/delete/{site}/{id}', 'OrderController@delete');
    Route::get('/download-pdf/{type}/order/{id}', 'OrderController@labelDownload')->name('download.pdf.order');
    Route::get('/fetch/select/{id}', 'OrderController@fetchSelect')->name('fetch.select');
    Route::post('/fetch/select/next', 'OrderController@fetchSelectNext')->name('fetch.select.next');
    Route::post('/fetch/{id}', 'OrderController@fetch')->name('fetch');
    Route::post('/invoice_submit2', 'OrderController@invoice_submit2')->name('invoice.submit2');
    Route::get('/download', function(){
        return view('bol::download');
    })->name('download.label');
    Route::post('/label_download', 'OrderController@downloadLabel');

    // Above all verified


    // Download PDF

    
    

    Route::post('/update_orders', 'OrderController@updateOrders')->middleware('auth');
    
    
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



    // Not confirmed
    Route::get('/Exportcsv/{recid}',[
        "uses" => 'CsvexportController@getExport',
        "as" => 'Exportcsv'
    ]);



    Route::get('/wallet-invoice/{id}', 'MollieController@walletInvoice')->middleware('auth');
    Route::get('/download-custom-label','CustomOrderController@downloadCustomLabel')->middleware('auth');


    Route::post('/track-order-submit','OrderController@trackOrder')->name('track.order.submit');
    // Route::get('/unikoop/payment-invoice/{id}','UnikoopController@paymentInvoice');
});



