<?php

use App\Order;
use App\Dish;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Order::class, 5) -> create()
            -> each(function($order) {
                $dishes = Dish::inRandomOrder()
                          -> limit(5)
                          -> get();
                $order -> dishes() -> attach($dishes);
                $order -> save();
            });
    }
}
