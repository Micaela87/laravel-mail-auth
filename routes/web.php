<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'Web\HomeController@home')->name('home');

Route::get('/{any}', 'Web\HomeController@home')->where('any', '.*')->middleware('auth');

// Route::middleware('auth')->group(function() {
//     Route::get('/{any}', 'HomeController@home')->where('any', '.*')->name('home');
// });

// Auth::routes();
