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

    /**
     * Frontendroutes
     */
    Route::get('/home', 'HomeViewController@index');
    Route::get('/', 'HomeViewController@index');
    Route::get('/news/{id}', 'HomeViewController@show');

    Route::get('/info', 'InfoFrontendViewController@index');

    Route::get('/gamedays', 'GamedayFrontendViewController@index');
    Route::get('/gamedays/{id}', 'GamedayFrontendViewController@show');

    Route::get('/team', 'UserFrontendViewController@index');

    Route::get('/users/{id}', 'UserFrontendViewController@show');


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

        Route::get('/backend/gamedays', 'GamedayBackendViewController@index');
        Route::get('/backend/gamedays/{id}/edit', 'GamedayBackendViewController@edit');
        Route::get('/backend/gamedays/create', 'GamedayBackendViewController@create');
        Route::post('/backend/gamedays', 'GamedayBackendViewController@store');
        Route::put('/backend/gamedays/{id}', 'GamedayBackendViewController@update');
        Route::delete('/backend/gamedays/{id}', 'GamedayBackendViewController@destroy');

        Route::get('/backend/users', 'UserBackendViewController@index');
        Route::get('/backend/', 'UserBackendViewController@index');
        Route::get('/backend/users/{id}/edit', 'UserBackendViewController@edit');
        Route::get('/backend/users/create', 'UserBackendViewController@create');
        Route::post('/backend/users', 'UserBackendViewController@store');
        Route::put('/backend/users/{id}', 'UserBackendViewController@update');

        Route::put('/backend/playercards/{id}', 'PlayercardBackendViewController@update');
        Route::put('/backend/playercardpictureupload/{id}', 'PlayercardBackendViewController@upload');

        Route::put('/backend/permissions/{id}', 'UserToRgBackendViewController@update');

        Route::get('/backend/logs', 'LogBackendViewController@index');
    });
});


