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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Authentication register and login route
Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');

Route::middleware('auth:api')->group(function () {
    // Authentication logout route
    Route::post('logout', 'Api\AuthController@logout');

    Route::get('customerAccountDetail', 'Api\CustomerInfo@customerAccountDetail');


    // All about product routes
    Route::get('productlist', 'Api\ProductlistController@getGuzzleRequest'); // product list dari bss
    Route::get('productlistm','ProductlistmobileController@index');// productlis mobile send client
    Route::apiResource('plans', 'Api\PlanController');
    Route::apiResource('products', 'Api\ProductController');
    Route::put('product/{product}/activate', 'Api\ProductController@activate');
    Route::put('product/{product}/deactivate', 'Api\ProductController@deactivate');
    Route::apiResource('productTypes', 'Api\ProductTypeController@index');
    Route::apiResource('zonePrices', 'Api\ZonePriceController')->except([
        'index', 'update'
    ]);
    Route::get('zonePrices/{product_id}/{zone_id}', 'Api\ZonePriceController@show')->name('zonePrices.show');
    Route::put('zonePrices/{product_id}/{zone_id}', 'Api\ZonePriceController@update')->name('zonePrices.update');

    // Customer balance and purchase order routes
    Route::apiResource('customerBalances', 'Api\CustomerBalanceController');
    Route::apiResource('purchaseOrders', 'Api\PurchaseOrderController');

    // Customer and user routes
    Route::apiResource('customers', 'Api\CustomerController');
    Route::apiResource('users', 'Api\UserController');
    Route::get('currentUserSlightInfo', 'Api\UserController@getCurrentUserSlightInfo');

    // Banner routes
    Route::apiResource('banners', 'Api\BannerController');
    Route::get('getDisplayBanner/{id}', 'Api\BannerController@getBanner');
});
