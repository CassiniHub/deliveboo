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

Route::get('filter/category/{id}', 'ApiController@index')
    ->name('get-category');

Route::post('create/order/{dishesIds}', 'OrderController@createOrder')
    ->name('orders.createOrder');

// CHARTS ROUTES
Route::get('chart/restaurant/{id}', 'RestaurantController@getOrders')
    ->name('restaurants.getOrders');

Route::get('chart/restaurant/year/{id}/{year}', 'RestaurantController@getOrdersYears')
    ->name('restaurants.getOrdersYears');

Route::get('/chart/dishes/{id}', 'RestaurantController@getOrderDishes')
    ->name('direstaurants.getOrderDishes');