<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Dish;
use Faker\Generator as Faker;

$factory->define(Dish::class, function (Faker $faker) {
    return [
        'name'        => $faker -> word(),
        'ingredients' => $faker -> sentence($nbWords = 8, $variableNbWords = true),
        'discount'    => $faker -> randomElement($array = array (0, 0, 0, 10, 20)),
        'price'       => $faker -> randomFloat($nbMaxDecimals = 2, $min = 2, $max = 15),
        'img'         => $faker -> imageUrl($width = 640, $height = 480),
        'type'        => $faker -> randomElement($array = array ('primo','secondo','contorno'))
    ];
});