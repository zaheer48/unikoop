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

Route::prefix('trackorder')->group(function() {
    Route::get('track-order', function () {
            return view('trackorder::index');
            })->name('track.order');
    Route::post('/check-order', 'TrackOrderController@check_order')
            ->name('check.order');
});
