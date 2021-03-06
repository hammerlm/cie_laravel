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

/*
// the following routes are just some routes for testing
// BEGIN #1
Route::get('/backend', function () {
    return view('masterlayoutfiles.backendmaster');
});

Route::get('/frontend', function () {
    return view('masterlayoutfiles.frontendmaster');
});

Route::get('/home', function () {
    return view('shownewslistfe');
});

Route::get('/newssinglefe', function () {
    return view('shownewssinglefe');
});

Route::get('/playercardsfe', function () {
    return view('showplayercardlistfe');
});

Route::get('/createnewssinglebe', function () {
    return view('createnewssinglebe');
});

Route::get('/gamedaylistfe', function () {
    return view('showgamedaylistfe');
});

Route::get('/gamedaysinglefe', function () {
    return view('showgamedaysinglefe');
});

Route::get('/editnewssinglebe', function () {
    return view('editgamedaysinglebe');
});

Route::get('/managegamedaylocationsbe', function () {
    return view('managegamedaylocationsbe');
});

Route::get('/newslistbe', function () {
    return view('shownewslistbe');
});

Route::get('/userlistbe', function () {
    return view('showuserlistbe');
});

Route::get('/editusersinglebe', function () {
    return view('editusersinglebe');
});

Route::get('/managepermissionsbe', function () {
    return view('managepermissionsbe');
});
// END #1
*/

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
