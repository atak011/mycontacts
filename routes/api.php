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




Route::post('/tokens/create', 'App\Http\Controllers\AuthController@createToken');
Route::get('/todo','App\Http\Controllers\TodoController@index');


Route::middleware('auth:sanctum')->group(function (){
    Route::get('/contact/search','App\Http\Controllers\ContactController@search');
    Route::resource('/contact','App\Http\Controllers\ContactController');
});

