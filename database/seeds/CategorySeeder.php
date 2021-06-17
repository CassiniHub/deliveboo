<?php

use App\Category;
use App\Restaurant;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class, 10) -> create()
            -> each(function($category) {
                $restaurant = Restaurant::inRandomOrder()
                            -> limit(5)
                            -> get();
                $category -> restaurants() -> attach($restaurant);
                $category -> save();
            });
    }
}
