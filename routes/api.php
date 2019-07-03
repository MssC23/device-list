<?php

use Illuminate\Http\Request;
Use App\Devices;

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

Route::get('/devices', 'DeviceController@index')->name('devices.all');
Route::post('/devices', 'DeviceController@store')->name('devices.store');
Route::patch('/devices/{id}', 'DeviceController@update')->name('devices.update');
Route::delete('/devices/{id}', 'DeviceController@destroy')->name('devices.destroy');


