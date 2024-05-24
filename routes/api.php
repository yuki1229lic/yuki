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

Route::get('/prefectureList', [App\Http\Controllers\AddressControllers::class, 'getPrefectureList']);
Route::get('/getCityList/{prefecture?}', [App\Http\Controllers\AddressControllers::class, 'getCityList']);
Route::get('/getJobsKenGroupList/{ken_group_id?}', [App\Http\Controllers\AddressControllers::class, 'getJobsKenGroupList']);
Route::get('/getJobsCityGroupList/{ken_group_id?}', [App\Http\Controllers\AddressControllers::class, 'getJobsCityGroupList']);
Route::get('/getKenCityByPost/{zip?}', [App\Http\Controllers\AddressControllers::class, 'getKenCityByPost']);

