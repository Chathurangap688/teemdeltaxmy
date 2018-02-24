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

Route::get('/', function () {
    return view('welcome');
});

// Admin auth Routes
\App\Http\Controllers\Auth\AdminLoginController::routes(); // please take a look at this method to get an idea

// Admin routes
\App\Http\Controllers\AdminController::routes();