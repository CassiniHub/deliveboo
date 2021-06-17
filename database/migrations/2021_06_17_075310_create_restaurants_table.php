<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table -> id();

            $table -> string('name');
            $table -> string('address');
            $table -> string('email', 128);
            $table -> string('telephone', 32);
            $table -> text('description') -> nullable();
            $table -> string('img_cover') -> nullable(); // Add default
            $table -> string('logo') -> nullable();      // Add default
            $table -> boolean('allow_cash');
            $table -> decimal('delivery_cost');
            $table -> boolean('is_visible') -> default(false);

            $table -> softDeletes();
            $table -> bigInteger('user_id') -> unsigned() -> index();

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
        Schema::dropIfExists('restaurants');
    }
}
