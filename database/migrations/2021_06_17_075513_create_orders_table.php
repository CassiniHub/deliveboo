<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table -> id();

            $table -> decimal('tot_price');
            $table -> integer('status');
            $table -> text('notes') -> nullable();
            $table -> string('delivery_address');
            $table -> dateTime('order_datetime') ->default(now());
            $table -> string('email', 128);
            $table -> string('doorbell_name');
            $table -> string('telephone', 32);

            $table -> softDeletes();
            $table -> bigInteger('restaurant_id') -> unsigned() -> index();

            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
