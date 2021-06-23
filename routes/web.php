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

// authentication routes
Auth::routes();
