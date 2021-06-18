<?php

use Illuminate\Support\Facades\Route;

// first view on opening
Route::get('/', function() {
    return view('pages.home');
});

Route::resources([
    'users'       => 'UserController',
    'restaurants' => 'RestaurantController',
    'categories'  => 'CategoryController',
    'dishes'      => 'DishController',
    'orders'      => 'OrderController',
]);

// authentication routes
Auth::routes();

// TEST -> reindirizzamento post login
Route::get('/dashboard', 'HomeController@index')
    ->name('dashboard');
