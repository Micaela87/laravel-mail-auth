<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// authentication routes

Route::post('/login', 'Api\ApiLoginController@login');


Route::post('/logout', 'Auth\LoginController@logout');

Route::post('/register', 'Auth\RegisterController@register');

// public routes
    // posts routes

Route::get('/posts', 'Api\PostsController@getAllPosts');

    // categories routes
Route::get('/categories', 'Api\CategoriesController@getAllCategories');

Route::get('/categories/{id}', 'Api\CategoriesController@getPostCategory');

    // tags routes
Route::get('/tags', 'Api\TagsController@getAllTags');

Route::get('/posts/{id}/tags', 'Api\TagsController@getTagsPerPost');

// private routes
    // posts routes

Route::get('/posts/{id}/delete', 'Api\PostsController@deletePost');

Route::get('/posts/{id}', 'Api\PostsController@getSinglePost');

Route::post('/posts/store', 'Api\PostsController@storeNewPost');

Route::post('/posts/{id}/update', 'Api\PostsController@updatePost');

