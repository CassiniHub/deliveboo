<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Dish;
use Faker\Generator as Faker;

$factory->define(Dish::class, function (Faker $faker) {
    return [
        'name'        => $faker -> word(),
        'ingredients' => $faker -> word() . ', ' . $faker -> word() . ', ' . $faker -> word() . ', ' . $faker -> word() . ', ' . $faker -> word() . ', ' . $faker -> word(),
        'price'       => $faker -> randomFloat($nbMaxDecimals = 2, $min = 2, $max = 15),
        'type'        => $faker -> randomElement($array = array ('Primi','Secondi','Contorni', 'Dolci', 'Panini', 'Pizze', 'Insalate'))
    ];
});
