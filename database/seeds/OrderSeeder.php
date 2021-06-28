<?php

use App\Order;
use App\Restaurant;
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
        factory(Order::class, 100) -> make()
            -> each(function($order) {
                $totPrice = 0;
                $dishes = null;

                $restaurant = Restaurant::inRandomOrder() -> first();
                
                for ($x=0; $x<6; $x++){
                    $dish = Dish::where('restaurant_id', $restaurant ->id) -> inRandomOrder() -> first();
                    $totPrice += $dish ->price;  
                    $dishes[$x] = $dish;                  
                }

                $order ->tot_price = $totPrice;
                $order -> restaurant() ->associate($restaurant ->id);
                $order ->save();

                foreach($dishes as $dish){
                    
                    $order ->dishes() ->attach($dish ->id);
                }
            });
    }
}
