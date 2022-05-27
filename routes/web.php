<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LampIotController;


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



Auth::routes(['register' => false]);
Route::middleware(['auth'])->group(function(){  
    Route::redirect('/overview', url('/'));
    //Route::redirect('/password/confirm', url('/'));
    Route::get('/', 'DashboardController@dashboard')->name('home');
    /*Route::get('/welcome', function () {
        Alert::success('Success Control AC', 'hehe');
        return view('welcome');
    });*/

    Route::get('/overview/update-temperature', 'DashboardController@temperatureAjax')->name('chart-temperature.update'); 
    Route::get('/overview/update-overview', 'DashboardController@overviewAjax')->name('overview.update'); 
    Route::get('/overview/update-light', 'DashboardController@lightAjax')->name('light.update'); 
    Route::get('/overview/update-door', 'DashboardController@doorAjax')->name('door.update'); 

    Route::get('/overview/room-1', 'DashboardController@room1Ajax')->name('room1.update'); 
    Route::get('/overview/room-2', 'DashboardController@room2Ajax')->name('room2.update'); 
    Route::get('/overview/room-3', 'DashboardController@room3Ajax')->name('room3.update'); 



    Route::get('/log-smarthome', 'LogEventController@index')->name('log-event.index'); 
    Route::get('/setting', 'DashboardController@settings')->name('setting.index'); 
    Route::get('/cctv', 'DashboardController@viewCCTV')->name('cctv.index'); 

    Route::post('/log-smarthome/log-events', 'LogEventController@logEventData')->name('log-event.data');
    Route::post('/overview/action-ac', 'DashboardController@arduinoAPIActionAC')->name('action.ac'); 
    Route::post('/overview/email-notificatication', 'DashboardController@emailNotification')->name('email.notification'); 


    //Route::post('/overview/update-light','DashboardController@lightAjax')->name('light.update-post');
});



