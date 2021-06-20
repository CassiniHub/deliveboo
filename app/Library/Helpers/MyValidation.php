<?php

namespace App\Library\Helpers;

class MyValidation {    
    static function validateRestaurant() {
        return [
            'name' => 'required|string|max:255', 
            'address' => 'required|string|max:255',
            'email' => 'required|string|max:128',
            'telephone' => 'required|string|max:32',
            'description' => 'nullable|string',
            'allow_cash' => 'required|boolean',
            'delivery_cost' => 'required|numeric',
            'is_visible' => 'nullable|boolean',
        ];
    }

    // WARNING -> check with migrations
    static function validateDish() {
        return [
            'name' => 'required|string|max:255',
            'ingredients' => 'required|JSON',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
        ];
    }

    static function validateCategory() {
        return [
            'name' => 'required|string|max:64',
            'description' => 'nullable|string',
        ];
    }

    static function validateOrder() {
        return [
            'tot_price' => 'required|numeric',
            'status' => 'required|numeric',
            'notes' => 'nullable|string',
            'delivery_address' => 'required|string',
        ];
    }
}