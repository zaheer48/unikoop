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

Route::group(['middleware' => ['superadmin'], 'prefix' => 'packinglisttemplate'], function() {
    Route::resource('/packinglist-templates', 'PackingListTemplateController');
    Route::get('/packlist-template-default/{id}', 'PackingListTemplateController@setDefault')
            ->name('packlist-templates.setDefault');
});
