<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'status'           => 0,
        'notes'            => $faker -> text($maxNbChars = 300),
        'delivery_address' => $faker -> address(),
    ];
});
