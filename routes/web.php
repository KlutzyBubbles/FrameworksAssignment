<?php

/*
 * Need to manually declare auth routes to remove the register routes
 */
Route::group(['middleware' => ['web']], function () {
    // Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::get('logout', 'Auth\LoginController@logout');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::get('/', 'HomeController@index');
    Route::get('/dashboard', 'HomeController@dashboard');

    Route::get('/booking/{id}/destroy', 'BookingController@destroy');
    Route::get('/customer/{id}/destroy', 'CustomerController@destroy');
    Route::get('/itinerary/{id}/destroy', 'ItineraryController@destroy');
    Route::get('/review/{id}/destroy', 'ReviewController@destroy');
    Route::get('/tour/{id}/destroy', 'TourController@destroy');
    Route::get('/trip/{id}/destroy', 'TripController@destroy');
    Route::get('/vehicle/{id}/destroy', 'VehicleController@destroy');
    Route::get('/staff/{id}/destroy', 'StaffController@destroy');

    Route::resource('booking', 'BookingController');
    Route::resource('customer', 'CustomerController');
    Route::resource('itinerary', 'ItineraryController');
    Route::resource('review', 'ReviewController');
    Route::resource('tour', 'TourController');
    Route::resource('trip', 'TripController');
    Route::resource('vehicle', 'VehicleController');
    Route::resource('staff', 'StaffController');
});
