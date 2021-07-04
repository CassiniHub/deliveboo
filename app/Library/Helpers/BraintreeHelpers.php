<?php

namespace App\Library\Helpers;

class BraintreeHelpers {

    static function config()
    {
        return [
            'environment' => config('services.braintree.environment'),
            'merchantId'  => config('services.braintree.merchantId'),
            'publicKey'   => config('services.braintree.publicKey'),
            'privateKey'  => config('services.braintree.privateKey')
        ];
    }
}


