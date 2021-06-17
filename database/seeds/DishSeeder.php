<?php


use App\Dish;
use App\Restaurant;
use Illuminate\Database\Seeder;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Dish::class, 30) -> make()
            -> each(function($dish) {
                $restaurant = Restaurant::inRandomOrder() -> first();
                $dish -> restaurant() -> associate($restaurant);
                $dish -> save();
            });
    }
}