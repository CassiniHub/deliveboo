<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishes', function (Blueprint $table) {
            $table -> id();

            $table -> string('name');
            $table -> string('ingredients');
            $table -> decimal('price');
            $table -> integer('discount') -> nullable();
            $table -> string('img') -> nullable(); // Add default
            $table -> string('type', 64);
            $table -> boolean('is_visible') -> default(false);

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
        Schema::dropIfExists('dishes');
    }
}