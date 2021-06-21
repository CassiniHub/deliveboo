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
                'name' => 'Pizza',
                'description' => 'La migliore pizza consegnata rapidamente alla tua porta',
                'img_cover' => 'storage/images/categories/pizza.jpeg'
            ],
            [
                'name' => 'Sushi',
                'description' => 'Il Miglior Sushi consegnato direttamente a casa tua',
                'img_cover' => 'storage/images/categories/barca-sushi.jpg'
            ],
            [
                'name' => 'Dessert',
                'description' => 'Togliti uno sfizio e gustati un ottimo dessert comodamente sul tuo divano',
                'img_cover' => 'storage/images/categories/dunkindonuts.jpg'
            ],
            [
                'name' => 'Poke',
                'description' => 'Il miglior poke consegnato direttamente a casa tua',
                'img_cover' => 'storage/images/categories/poke.jpg'
            ],
            [
                'name' => 'Healthy',
                'description' => 'Non solo gustosi ma anche salutari!',
                'img_cover' => 'storage/images/categories/healty.jpeg'
            ],
            [
                'name' => 'Gelato',
                'description' => 'Il miglior gelato consegnato direttamente a casa tua',
                'img_cover' => 'storage/images/categories/grom.png'
            ],
            [
                'name' => 'Hamburger',
                'description' => 'Il milgior hamburger consegnato direttamente a casa tua',
                'img_cover' => 'storage/images/categories/hamburger-patate.jpg'
            ],
            [
                'name' => 'Kebab',
                'description' => 'Il miglior kebab consegnato direttamente a casa tua',
                'img_cover' => 'storage/images/categories/kebab.jpeg'
            ],
            [
                'name' => 'Sandwich',
                'description' => 'Per un pasto al volo! Il miglior Sanwich per te',
                'img_cover' => 'storage/images/categories/sandwich.jpeg'
            ],
            [
                'name' => 'Americano',
                'description' => 'Il meglio del cibo di strada americano! Ordinalo comodamente da casa',
                'img_cover' => 'storage/images/categories/roadhouse.jpg'
            ],
            [
                'name' => 'Italiano',
                'description' => 'Squisita e variegata! Il meglio della cucina italiana direttamente a casa tua',
                'img_cover' => 'storage/images/categories/italiano.jpeg'
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
