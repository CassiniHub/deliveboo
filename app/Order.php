<?php

namespace App;

use App\Dish;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'tot_price', 'status', 'notes', 'delivery_address'
    ];

    public function dishes() {
        return $this -> belongsToMany(Dish::class);
    }
}
