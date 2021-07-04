<?php

namespace App\Library\Helpers;

class CheckFormData
{
    static function restaurantsTextFields() {
        return 
        [
            'name',
            'address',
            'description'
        ];
    }

    static function dishesTextFields() {
        return 
        [
            'name',
            'ingredients',
        ];
    }

    public function getTextFieldsValues($array, $request) {
        $textFieldsValues = [];
        foreach ($array as $fieldValue) {
            $textFieldsValues[] = $request -> $fieldValue;
        }
        return $textFieldsValues;
    }

    public function checkSpecialChar($array) {
        $dangerChars = ['{', '}', '>', '<', '[', ']', '=', '+', '&', '$', '#'];
        foreach ($array as $fieldValue) {
            foreach ($dangerChars as $char) {
                if (strpos($fieldValue, $char)){
    
                    return back() ->withErrors('La descrizione non può contenere i seguenti caratteri: { } > < [ ] = + & $ #');
                }
            }
        }
    }

    public function checkPhoneNumber($request) {
        $telephone = $request -> telephone;
        $telephone_num = intval($telephone);
        $telephone_str = strval($telephone_num);
        
        if ($telephone_str != $telephone) {
            
            return back() ->withErrors('Il numero di telefono inserito non è valido');
        }
    }
}

