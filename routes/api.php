<?php

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

/**
 * Define basic route arguments patterns
 */
Route::pattern('id', '[0-9]+');

/**
 * Products routes
 */
Route::prefix('products')->group(function() {
    Route::get('/get-list', 'ProductController@getProductsList');
    Route::post('/update/{id}', 'ProductController@update');
    Route::post('/create', 'ProductController@create');
    Route::delete('/delete/{id}', 'ProductController@delete');
    Route::post('/restore/{id}', 'ProductController@restore');
});

/**
 * Categories routes
 */
Route::prefix('categories')->group(function() {
    Route::get('/get-list', 'CategoryController@getCategories');
    Route::post('/create', 'CategoryController@create');
    Route::post('/update/{id}', 'CategoryController@update');
    Route::delete('/delete/{id}', 'CategoryController@delete');
});

/**
 * Characteristics routes
 */
Route::prefix('/characteristics')->group(function () {
    Route::get('get', 'CharacteristicController@get');
});


