<?php

use App\Category;
use App\Restaurant;
use Illuminate\Database\Seeder;
Use App\Library\Helpers\Seeders;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Seeders::categoriesSeeds();

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
