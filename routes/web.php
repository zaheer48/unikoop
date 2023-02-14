<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\OrderTrackController;

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
    return view('auth.login');
})->name('home')->middleware('guest');

Route::get('track-order', function () {
    return view('trackorder');
})->name('track.order');

Route::post('/checkorder', [OrderTrackController::class, 'check_order'])->name('check.order');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');


Route::get('/see-you', function () {
    return view('see_you');
})->name('see.you');

Route::post('/order-track', [OrderTrackController::class, 'store']
)->name('order-track');



// Not Confirmed
/** Guest Routes **/
Route::get('/searching', 'SiteController@searching')->name('site.search');




//




Route::middleware(['usertype'])->group(function(){

    
    Route::get('/test', [Controllers\TestController::class, 'test']
        )->name('test');
    
    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified'
    ])->group(function () {
        Route::get('/dashboard', 'UserController@dashboard')->name('dashboard');
    });
    // Wallet
    Route::get('/my-wallet', function () {
        return view('userwallet.index');}
    )->name('my.wallet');
    Route::get('/wallet-invoice/{id}', 'MollieController@walletInvoice')->middleware('auth')->name('wallet.invoice');
    Route::post('/recharge-wallet', 'MollieController@rechargeWallet')->name('recharge.wallet');
    Route::get('/mollio-success', 'MollieController@successPayment')->name('mollio.success.payment');
    Route::post('webhooks/mollie', 'MollieController@handle')->name('webhooks.mollie');
    
    // User Profile
    Route::get('/myprofile', function () {
        return view('user.profile.profile');
    })->name('my.profile');
    Route::get('/myprofile-edit/{id}', function ($id) {
        $user = \App\Models\User::find($id);
        return view('user.profile.edit', compact('user'));
    })->name('profile.edit');
    Route::post('myprofile-update/{id}', 'NotificationController@profileupdate')->name('profile.update');
    
    Route::get('/changepassword', function () {
        return view('user.changepassword.index');
    })->name('cahnge.password');
    Route::post('changepassword-store', 'NotificationController@changepass')->name('cahnge.password.update');
    
    Route::get('/bussiness-info', function () {
        return view('user.business_info');
    })->name('business.info');
    Route::post('bussiness-info-update/{id}', 'NotificationController@bussinessinfo')->name('business.info.update');
    
    // Email templates
    Route::resource('/email-templates', 'UserEmailTemplatesController');
    // Invoice
    Route::resource('/invoice-templates', 'UserInvoiceTemplatesController');
    Route::get('/invoice-template-preview/{id}', 'UserInvoiceTemplatesController@preview');
    Route::get('/set-invoice-template-default/{id}', 'UserInvoiceTemplatesController@setDefault');
    // Service
    Route::get('/service-bank/edit/{slug}', 'UserInvoiceTemplatesController@serviceedit')->name('service_bank.service.edit');
    Route::post('/service-bank/update/{id}', 'UserInvoiceTemplatesController@serviceupdate')->name('service_bank.service.update');
    // Packlist
    Route::resource('/packinglist-templates', 'UserPacklistTemplatesController')->middleware('auth');
    Route::get('/packlist-template-preview/{id}', 'UserPacklistTemplatesController@preview')->middleware('auth');
    // Payment History
    Route::get('/payment-invoice/{id}', 'MollieController@paymentInvoice')->name('payment.invoice');
    Route::get('/custom-payment-invoice/{id}', 'CustomOrderController@paymentInvoice')->name('custom.payment.invoice');
    // PAyment
    Route::get('/payment-history', function () {
        return view('payment-history.index');
    })->name('payment.history');
    Route::get('/account-report', 'NotificationController@accountReport')->name('account.report');

    Route::view('header','layouts/header');
    Route::view('footer','layouts/footer');

    //Product Route
    Route::view('AddProduct','layouts/Product/AddProduct')->name('AddProduct');
    Route::view('ProductList','layouts/Product/ProductList')->name('ProductList');
    Route::view('UpdateProduct','layouts/Product/UpdateProduct')->name('UpdateProduct');

    Route::view('createinvoice','layouts/createinvoice')->name('createinvoice');
    Route::view('allTransaction','layouts/allTransaction')->name('allTransaction');
    Route::view('downloadLabel','layouts/downloadLabel')->name('downloadLabel');
    Route::view('uploadBolSheet','layouts/uploadBolSheet')->name('uploadBolSheet');
    Route::view('allBolSheet','layouts/allBolSheet')->name('allBolSheet');
    Route::view('lock-screen','layouts/lockScreen')->name('lockScreen');

    Route::view('getinvoice','/getInvoice')->name('getinvoice');
});


//Route::get('admin/login',function(){return view('admin_login');})->name('admin.login');
Route::post('/adminlogin','AdminLoginController@login');


/** Admin Routes **/
Route::group(['middleware' => 'superadmin'], function () {
    Route::get('/admin_dashboard', 'HomeController@adminDashboard')->name('admin.dashboard');
    Route::post('/store', 'UserCreateController@store');
    Route::get('/create', 'UserCreateController@create');

    Route::resource('/users', 'UsersController');

    Route::resource('subadmins', 'SubAdminsController');
    Route::post('subadmins/activate/{id}', 'Admin\UserActivationController@activateSuperadmin');
    Route::post('subadmins/deactivate/{id}', 'Admin\UserActivationController@deactivateSuperadmin');
    Route::post('users/activate/{id}', 'Admin\UserActivationController@activate');
    Route::post('users/deactivate/{id}', 'Admin\UserActivationController@deactivate');
    Route::resource('admin-profile', 'AdminProfileController');
    Route::resource('changepass', 'ChangepasswordController');
    Route::post('/adminSellingplanregis', 'UserCreateController@storesellplan');
    Route::post('/adminBussiness', 'UserCreateController@storeBussiness_address');
    Route::post('/adminBankdetail', 'UserCreateController@storebankdetail');
    Route::post('/adminchargeoption', 'UserCreateController@chargeoption');
    Route::post('/adminCreditCard', 'UserCreateController@storeCharge_method');
    Route::post('/adminLogistiek', 'UserCreateController@storelogistiek');

    Route::get('/label-pricing', 'Admin\LabelPricingController@index')->name('label.pricing');
    Route::get('/label-pricing/create', 'Admin\LabelPricingController@create')->name('label.pricing.create');
    Route::get('/label-pricing/{id}/edit', 'Admin\LabelPricingController@edit')->name('label.pricing.edit');
    Route::post('/label-pricing', 'Admin\LabelPricingController@store')->name('label.pricing.store');

    Route::get('/payment-methods', 'PaymentMethodsController@index')->name('payment.methods');
    Route::post('/payment-methods', 'PaymentMethodsController@store');
    Route::get('/activation', 'ActivationController@index')->name('activate.settings');
    Route::post('/switch-activation', 'ActivationController@switchOperation');
    Route::get('/site-settings', 'WebsiteController@index')->name('website.settings');
    Route::get('/update-site-settings', 'WebsiteController@edit');
    Route::post('/update-site-settings', 'WebsiteController@update');
    Route::post('/delete-partner', 'WebsiteController@deletePartner');
    Route::resource('/user_requests', 'Admin\UserRequestController');
    Route::resource('/email-template', 'EmailTemplateController');
    Route::resource('/email-categories', 'EmailCategoryController');
    Route::get('/email/status/{id1}/{id2}', 'UserUpdateController@status')->name('admin-template-st');
    Route::resource('/invoice-template', 'InvoiceTemplateController');
    Route::resource('/pack_list-template', 'PacklistTemplateController');
    Route::post('/adminLogistiekupdate', 'UserUpdateController@updatelogistiek');
    Route::post('/adminBussinessupdate', 'UserUpdateController@updateBussiness_address');
    Route::post('/adminSellingplanupdate', 'UserUpdateController@updatesellplan');
    Route::post('/adminBankdetailupdate', 'UserUpdateController@updatebankdetail');
    Route::post('/adminchargeoptionupdate', 'UserUpdateController@chargeoptionupdate');
    Route::post('/adminCreditCardupdate', 'UserUpdateController@updateCharge_method');

    
});















