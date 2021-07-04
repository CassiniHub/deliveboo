<?php

use App\Restaurant;
use App\User;
use App\Category;

use Illuminate\Database\Seeder;
Use App\Library\Helpers\Seeders;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $restaurants = Seeders::restaurantsSeeds();
        $restaruantsArray = [];

        foreach ($restaurants as $restaurant) {
            $restaruantsArray[] = Restaurant::make($restaurant);
        }

        foreach ($restaruantsArray as $restaurant) {
            $user = User::inRandomOrder() -> first();
            $restaurant -> user() -> associate($user);
            $restaurant -> save();

            $categories = Category::inRandomOrder() 
                -> limit(rand(1, 3))
                ->get();
            $restaurant -> categories() -> attach($categories);
        }
    }
}
