<?php

use Illuminate\Http\Request;

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
// api for send data to mobiles devices
Route::post('productlist','Api\ProductNetOneMobileController@products');
Route::post('deviceslist','Admin\DevicesNetOneController@Consume_Devices');
Route::post('bannerslist','Api\BannersNetOneApiController@Index');

// api for download product as excel(export product in excel)
Route::get('products/download', 'Admin\ProductNetOneController@downloadAsExcel')->name('admin.products.download')->middleware('auth');
Route::get('rewards/download', 'Admin\RewardController@downloadAsExcel')->name('admin.rewards.download')->middleware('auth');