<?php

use Illuminate\Support\Facades\Route;

// first view on opening
Route::get('/', 'RestaurantController@index') 
     -> name('homepage');

Route::resources([
    'users'       => 'UserController',
    'restaurants' => 'RestaurantController',
    'categories'  => 'CategoryController',
    'dishes'      => 'DishController',
    'orders'      => 'OrderController',
]);

// CUSTOM RESTAURANTS ROUTES
Route::get('/restaurants/protectedOrders/{id}', 'RestaurantController@protectedOrders')
    ->name('restaurants.protectedOrders');
Route::get('/restaurants/protectedStatistics/{id}', 'RestaurantController@protectedStatistics')
    ->name('restaurants.protectedStatistics');
Route::get('/restaurants/protectedShow/{id}', 'RestaurantController@protectedShow')
    ->name('restaurants.protectedShow');

// CUSTOM DISHES ROUTES
Route::get('/dishes/createDish/{id}', 'DishController@createDish')
    ->name('dishes.createDish');
Route::post('/dishes/storeDish/{id}', 'DishController@storeDish')
    ->name('dishes.storeDish');
Route::post('/dishes/changeVisibility/{id}', 'DishController@changeVisibility')
    ->name('dishes.changeVisibility');

// PAYMENTS ROUTES
Route::get('/checkouts/{dishesIds}', 'CheckoutController@index')
    ->name('checkouts.index');
Route::post('/checkouts/transaction/{totPrice}/{dishes_ids}', 'CheckoutController@transaction')
    ->name('checkouts.transaction');

Route::view('/success', 'pages.orders.success');

// authentication routes
Auth::routes();
