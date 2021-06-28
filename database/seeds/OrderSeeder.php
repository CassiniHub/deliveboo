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
        factory(Order::class, 100) -> make()
            -> each(function($order) {
                $totPrice = 0;
                $dishes = null;

                for ($x=0; $x<10; $x++){
                    $dish = Dish::inRandomOrder() -> first();
                    $totPrice += $dish ->price;  
                    $dishes[$x] = $dish;                  
                }

                $order ->tot_price = $totPrice;
                $order ->save();

                foreach($dishes as $dish){
                    
                    $order ->dishes() ->attach($dish ->id);    
                }
            });
    }
}
