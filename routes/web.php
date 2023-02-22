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
    return view('auth.login');
})->name('home')->middleware('guest');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/see-you', function () {
    return view('see_you');
})->name('see.you');

// Not Confirmed
/** Guest Routes **/
Route::get('/searching', 'SiteController@searching')->name('site.search');

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
    // Payment
    Route::get('/payment-history', function () {
        return view('payment-history.index');
    })->name('payment.history');

    // Verified Above




    
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
   
    // Payment History
    Route::get('/payment-invoice/{id}', 'MollieController@paymentInvoice')->name('payment.invoice');
    Route::get('/custom-payment-invoice/{id}', 'CustomOrderController@paymentInvoice')->name('custom.payment.invoice');
    
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

// Track Invoice 
Route::get('/invoice', 'App\Http\Controllers\InvoiceController@invoice')->name('track.invoice');
Route::get('/download-invoice/{id}', 'UserInvoiceTemplatesController@downloadInvoice')->name('download.invoice.pdf');

Route::post('/adminlogin','AdminLoginController@login');

/** Admin Routes **/
Route::group(['middleware' => 'superadmin'], function () {
    Route::get('/admin_dashboard', 'HomeController@adminDashboard')->name('admin.dashboard');
    Route::get('/label-pricing', 'Admin\LabelPricingController@index')->name('label.pricing');
    Route::get('/label-pricing/create', 'Admin\LabelPricingController@create')->name('label.pricing.create');
    Route::get('/label-pricing/{id}/edit', 'Admin\LabelPricingController@edit')->name('label.pricing.edit');
    Route::post('/label-pricing', 'Admin\LabelPricingController@store')->name('label.pricing.store');
    Route::resource('/users', 'UserController');
    Route::post('users/activate/{id}', 'Admin\UserActivationController@activate');
    Route::post('users/deactivate/{id}', 'Admin\UserActivationController@deactivate');
    Route::resource('subadmins', 'SubAdminsController');
    Route::post('subadmins/activate/{id}', 'Admin\UserActivationController@activateSuperadmin');
    Route::post('subadmins/deactivate/{id}', 'Admin\UserActivationController@deactivateSuperadmin');
    Route::resource('/user_requests', 'Admin\UserRequestController');    
    // Payment Methods
    Route::get('/payment-methods', 'Admin\PaymentMethodsController@index')->name('payment.methods');
    Route::post('/payment-methods', 'Admin\PaymentMethodsController@store');

    Route::get('/activation', 'Admin\ActivationController@index')->name('activate.settings');
    Route::post('/switch-activation', 'Admin\ActivationController@switchOperation');

    Route::get('/site-settings', 'Admin\SettingController@index')->name('website.settings');
    Route::get('/update-site-settings', 'Admin\SettingController@edit');
    Route::post('/update-site-settings', 'Admin\SettingController@update');

    Route::get('/addons', 'Admin\AddonsController@index')->name('addons');
    Route::post('/addon_change_status', 'Admin\AddonsController@update')->name('addon.change.status');
    Route::post('/store', 'UserCreateController@store');
    Route::get('/create', 'UserCreateController@create');


    // Verified Above Super Admin


    

    // ----------------------

    


    
    Route::post('/delete-partner', 'Admin\SettingController@deletePartner');
    
    Route::resource('admin-profile', 'AdminProfileController');
    Route::resource('changepass', 'ChangepasswordController');
    Route::post('/adminSellingplanregis', 'UserCreateController@storesellplan');
    Route::post('/adminBussiness', 'UserCreateController@storeBussiness_address');
    Route::post('/adminBankdetail', 'UserCreateController@storebankdetail');
    Route::post('/adminchargeoption', 'UserCreateController@chargeoption');
    Route::post('/adminCreditCard', 'UserCreateController@storeCharge_method');
    Route::post('/adminLogistiek', 'UserCreateController@storelogistiek');
    
    
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















