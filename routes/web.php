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

Route::get('/restaurants/protectedShow/{id}', 'RestaurantController@protectedShow')
    ->name('restaurants.protectedShow');

Route::get('/dishes/createDish/{id}', 'DishController@createDish')
    ->name('dishes.createDish');

Route::post('/dishes/storeDish/{id}', 'DishController@storeDish')
    ->name('dishes.storeDish');
Route::post('/dishes/changeVisibility/{id}', 'DishController@changeVisibility')
    ->name('dishes.changeVisibility');
Route::get('/restaurants/protectedOrders/{id}', 'RestaurantController@protectedOrders')
    ->name('restaurants.protectedOrders');
Route::get('/restaurants/protectedStatistics/{id}', 'RestaurantController@protectedStatistics')
    ->name('restaurants.protectedStatistics');

// authentication routes
Auth::routes();
