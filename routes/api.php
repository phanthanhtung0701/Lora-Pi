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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::post('info', 'App\Http\Controllers\Api\NodeController@info');
Route::post('getNode', 'App\Http\Controllers\Api\NodeController@getNode');
Route::post('getAllNode', 'App\Http\Controllers\Api\NodeController@getAllNode');
Route::post('sendAction', 'App\Http\Controllers\Api\NodeController@sendAction');
Route::post('getAction', 'App\Http\Controllers\Api\NodeController@getAction');
Route::post('getAllAction', 'App\Http\Controllers\Api\NodeController@getAllAction');
