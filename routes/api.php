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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register', 'App\Http\Controllers\Api\RegisterController@store');
Route::post('login', 'App\Http\Controllers\Api\LoginController@vuelogin')->middleware("throttle:5,5");
Route::post('loginpage', 'App\Http\Controllers\Api\LoginController@loginpage');
Route::post('order', 'App\Http\Controllers\Api\ProductsController@order');


