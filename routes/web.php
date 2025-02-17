<?php

use Illuminate\Support\Facades\Route;
use League\CommonMark\Extension\Attributes\Node\Attributes;

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

Route::get('/', 'App\Http\Controllers\Auth\LoginController@showLoginForm');



Auth::routes();

// Route::view('/', 'page_login.login');

Route::group(['middleware' => 'auth'], function () {

    Route::resource('admin', 'App\Http\Controllers\C__dmin');
    Route::resource('dashboard', 'App\Http\Controllers\C_dashboard');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home');
