<?php

namespace App\Library\Helpers;

class MyValidation {    

    static function validateRestaurant() {

        return [
            'name'          => 'required|string|min:2|max:255',
            'address'       => 'required|string|min:6|max:255',
            'email'         => 'required|string|max:128|email',
            'telephone'     => 'required|string|max:32',
            'description'   => 'nullable|string',
            'allow_cash'    => 'required|boolean',
            'delivery_cost' => 'required|numeric',
            'is_visible'    => 'nullable|boolean',
        ];
    }

    // WARNING -> check with migrations
    static function validateDish() {
        return [
            'name'        => 'required|string|min:2|max:255',
            'ingredients' => 'required|string|min:2',
            'price'       => 'required|numeric|min:0.01',
            'type'        => 'required|string',
            'is_visible'     => 'required|boolean'
        ];
    }

    static function validateCategory() {
        return [
            'name'        => 'required|string|min:2|max:64',
            'description' => 'nullable|string',
        ];
    }

    static function validateOrder() {
        return [
            'notes'             => 'nullable|string',
            'delivery_address' => 'required|string',
            'email'            => 'required|string|max:128|email',
            'telephone'        => 'required|string|max:32',
            'doorbell_name'    => 'required|string',
        ];
    }
}