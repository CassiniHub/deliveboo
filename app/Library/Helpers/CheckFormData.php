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
}

