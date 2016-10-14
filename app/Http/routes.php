<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => \App\Http\Middleware\ResetSessionRolesArrayIfNotAuthenticated::class, 'middleware' => 'web'], function () {
    // Authentication Routes...
    Route::get('login', 'Auth\AuthController@showLoginForm');
    Route::post('login', 'Auth\AuthController@login');
    Route::get('logout', 'Auth\AuthController@logout');

    // Registration Routes...
    Route::get('register', 'Auth\AuthController@showRegistrationForm');
    Route::post('register', 'Auth\AuthController@register');

    // Password Reset Routes...
    Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
    Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\PasswordController@reset');

    //Applicationroutes
    Route::get('/home', 'HomeViewController@index');
    Route::get('/', 'HomeViewController@index');
    Route::get('/news/{id}', 'HomeViewController@show');


    /**
     * Backendroutes
     */
    Route::group(['middleware' => 'auth'], function()
    {
        Route::get('/backend/news/{id}/edit', 'NewsBackendViewController@edit');
        Route::get('/backend/news/create', 'NewsBackendViewController@create');
        Route::get('/backend/news', 'NewsBackendViewController@index');
        Route::post('/backend/news', 'NewsBackendViewController@store');
        Route::put('/backend/news/{id}', 'NewsBackendViewController@update');
        Route::delete('/backend/news/{id}', 'NewsBackendViewController@destroy');
    });
});


