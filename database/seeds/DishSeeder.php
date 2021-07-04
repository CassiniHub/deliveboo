<?php


use App\Dish;
use App\Restaurant;
use Illuminate\Database\Seeder;
Use App\Library\Helpers\Seeders;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dishes = Seeders::dishesSeeds();
        $dishesArray = [];

        foreach ($dishes as $dish) {
            $dishesArray[] = Dish::make($dish);
        }

        foreach ($dishesArray as $dish) {
            $restaurant = Restaurant::inRandomOrder() -> first();
            $dish -> restaurant() -> associate($restaurant);
            $dish -> save();
        }
    }
}
