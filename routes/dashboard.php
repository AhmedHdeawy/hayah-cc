<?php

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
|
| USER 		=>	auth()->user()
|
| ADMIN		=>	auth()->guard('admin')->user()
\
*/

// Dashboard Routes
Route::prefix(LaravelLocalization::setLocale() . '/admin')
->name('admin.')
->group(function() {

	// Admin Login Routes
	Route::get('login', 'Auth\AdminLoginController@showLogin')->name('getLogin');
    Route::post('login', 'Auth\AdminLoginController@login')->name('postLogin');


	Route::group(['middleware'    =>  'admin'],function(){
	// Route::middleware(['admin', 'check_permission'])->group(function(){

        Route::group(['namespace' => 'Dashboard', 'middleware'  =>  ['check_permission']], function () {

            // Dashboard Routes
            Route::get('/', 'DashboardController@index')->name('dashboard.index');

            // Categories Routes
            Route::resource('categories', 'CategoriesController');

            // Governorates Routes
            Route::resource('governorates', 'GovernoratesController');

            // Cities Routes
            Route::resource('cities', 'CitiesController');

            // Centers Routes
            Route::resource('centers', 'CentersController');

            // CenterBranches Routes
            Route::resource('center-branches', 'CenterBranchesController');

            // Cards Routes
            Route::resource('cards', 'CardsController');

            // Admins Routes
            Route::resource('admins', 'AdminsController');

            // Roles Routes
            Route::resource('roles', 'RolesController');
            Route::get('permissions', 'RolesController@permissions')->name('roles.permissions');
        });

        // Admin Logout Route
        Route::post('logout', 'Auth\AdminLoginController@logout')->name('logout');

	});


});
