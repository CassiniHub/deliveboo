<?php

namespace App;

use App\Restaurant;
use App\Order;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'ingredients', 'price', 'type', 'is_visible'
    ];

    public function restaurant() {
        return $this -> belongsTo(Restaurant::class);
    }

    public function orders() {
        return $this -> belongsToMany(Order::class);
    }

}
