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
        $categories = [
            [
                'name' => 'Hamburger',
                'description' => 'Buoni gli hamburger',
                'img_cover' => 'storage/images/carousel-images/barca-sushi.jpg'
            ],
            [
                'name' => 'Pizza',
                'description' => 'Buona la pizza',
                'img_cover' => 'storage/images/carousel-images/barca-sushi.jpg'
            ],
            [
                'name' => 'Sushi',
                'description' => 'Buono il sushi',
                'img_cover' => 'storage/images/carousel-images/barca-sushi.jpg'
            ],
            [
                'name' => 'Cinese',
                'description' => 'Buono il cinese',
                'img_cover' => 'storage/images/carousel-images/barca-sushi.jpg'
            ],
            [
                'name' => 'Street Food',
                'description' => 'Buono lo street food',
                'img_cover' => 'storage/images/carousel-images/barca-sushi.jpg'
            ],
            [
                'name' => 'Fast Food',
                'description' => 'Buono il fast food',
                'img_cover' => 'storage/images/carousel-images/barca-sushi.jpg'
            ],
            [
                'name' => 'Toast',
                'description' => 'Buoni i toast',
                'img_cover' => 'storage/images/carousel-images/barca-sushi.jpg'
            ],
            [
                'name' => 'Pasticceria',
                'description' => 'Buoni i dolci',
                'img_cover' => 'storage/images/carousel-images/barca-sushi.jpg'
            ],
            [
                'name' => 'Gelati',
                'description' => 'Buoni i gelati',
                'img_cover' => 'storage/images/carousel-images/barca-sushi.jpg'
            ],
            [
                'name' => 'Vegani',
                'description' => 'Buoni le verdure',
                'img_cover' => 'storage/images/carousel-images/barca-sushi.jpg'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category)
                -> each(function($category) {
                    $restaurant = Restaurant::inRandomOrder()
                            -> limit(5)
                            -> get();
                    $category -> restaurants() -> attach($restaurant);
                    $category -> save();
                });
        }
    }
}
