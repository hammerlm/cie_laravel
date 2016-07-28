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
// END #1