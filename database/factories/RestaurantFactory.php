<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Restaurant;
use Faker\Generator as Faker;

$factory->define(Restaurant::class, function (Faker $faker) {
    return [
        'name'          => $faker -> company(),
        'address'       => $faker -> address(),
        'email'         => $faker -> email(),
        'telephone'     => $faker -> numerify('##########'), 
        'description'   => $faker -> text($maxNbChars = 300),
        'img_cover'     => $faker -> imageUrl($width = 640, $height = 480),
        'logo'          => $faker -> imageUrl($width = 300, $height = 300),
        'allow_cash'    => $faker -> boolean($chanceOfGettingTrue = 50),
        'delivery_cost' => $faker -> numberBetween(5, 10),
        'is_visible'    => true,
    ];
});
