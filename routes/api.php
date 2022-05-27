<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LampIotController;


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

//Route::get('/iot', 'DashboardController@arduinoAPISaveTemperatureHumidity')->name('arduino.save-temperature-humidity'); 
Route::get('/light-check', 'DashboardController@arduinoAPICheckLight')->name('arduino.check-light'); 
Route::get('/temperature-humidity-store', 'DashboardController@arduinoAPISaveTemperatureHumidity')->name('arduino.store-temperature-humidity'); 
Route::post('/door-check', 'DashboardController@arduinoAPICheckDoor')->name('arduino.check-door'); 
Route::post('/store-action-ac', 'DashboardController@arduinoAPIStoreActionAC')->name('arduino.store-action-ac'); 




