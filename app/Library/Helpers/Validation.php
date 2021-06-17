<?php

namespace App\Library\Helpers;

class Validation {    
    public function validateRestaurant() {
        return [
            'name' => 'required|string|max:255', 
            'address' => 'required|string|max:255',
            'email' => 'required|string|max:128',
            'telephone' => 'required|string|max:32',
            'description' => 'nullable|string',
            'img_cover' => 'nullable|string|',
            'logo' => 'nullable|string|',
            'allow_cash' => 'required|boolean',
            'delivery_cost' => 'required|numeric',
            'is_visible' => 'nullable|boolean',
        ];
    }

    public function validateDish() {
        return [
            'name' => 'required|string|max:255',
            'ingredients' => 'required|JSON',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'img' => 'nullable|string|',
            'type' => 'required|string|max:64',
            'is_visible' => 'nullable|boolean',
        ];
    }


    public function validateCategory() {
        return [
            'name' => 'required|string|max:64',
            'description' => 'nullable|string',
            'img_cover' => 'nullable|string',
        ];
    }

    public function validateOrder() {
        return [
            'tot_price' => 'required|numeric',
            'status' => 'required|numeric',
            'notes' => 'nullable|string',
            'delivery_address' => 'required|string',
        ];
    }
}