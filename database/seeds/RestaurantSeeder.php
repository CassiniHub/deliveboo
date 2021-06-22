<?php

use App\Restaurant;
use App\User;
use App\Category;

use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Restaurant::class, 20) -> make()
            -> each(function($restaurant) {
                $user = User::inRandomOrder() -> first();
                $restaurant -> user() -> associate($user);
                $restaurant -> save();

                $categories = Category::inRandomOrder() 
                    -> limit(rand(1, 5))
                    ->get();
                $restaurant -> categories() -> attach($categories);
            });
    }
}
