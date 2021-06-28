<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table -> foreign('user_id', 'userrestaurant')
                   -> references('id')
                   -> on('users');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table -> foreign('restaurant_id', 'orderrestaurant')
                   -> references('id')
                   -> on('restaurants');
        });

        Schema::table('dishes', function (Blueprint $table) {
            $table -> foreign('restaurant_id', 'restaurantdish')
                   -> references('id')
                   -> on('restaurants');
        });

        Schema::table('category_restaurant', function (Blueprint $table) {
            $table -> foreign('category_id', 'categoryrestaurant')
                   -> references('id')
                   -> on('categories');

            $table -> foreign('restaurant_id', 'restaurantcategory')
                   -> references('id')
                   -> on('restaurants');
        });

        Schema::table('dish_order', function (Blueprint $table) {
            $table -> foreign('dish_id', 'dishorder')
                   -> references('id')
                   -> on('dishes');

            $table -> foreign('order_id', 'orderdish')
                   -> references('id')
                   -> on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table -> dropForeign('userrestaurant');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table -> dropForeign('orderrestaurant');
        });

        Schema::table('dishes', function (Blueprint $table) {
            $table -> dropForeign('restaurantdish');
        });

        Schema::table('category_restaurant', function (Blueprint $table) {
            $table -> dropForeign('categoryrestaurant');
            $table -> dropForeign('restaurantcategory');
        });

        Schema::table('dish_order', function (Blueprint $table) {
            $table -> dropForeign('dishorder');
            $table -> dropForeign('orderdish');
        });
    }
}
