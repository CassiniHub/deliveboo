<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Restaurant;
use Faker\Generator as Faker;

$factory->define(Restaurant::class, function (Faker $faker) {
    return [
        'name'          => $faker -> word(),
        'address'       => $faker -> address(),
        'email'         => $faker -> email(),
        'telephone'     => $faker -> companyNumber,
        'description'   => $faker -> text($maxNbChars = 300),
        'img_cover'     => $faker -> imageUrl($width = 640, $height = 480),
        'logo'          => $faker -> imageUrl($width = 300, $height = 300),
        'allow_cash'    => $faker -> boolean($chanceOfGettingTrue = 50),
        'delivery_cost' => $faker -> randomFloat(0, 20),
    ];
});
