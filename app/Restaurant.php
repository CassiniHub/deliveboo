<?php

namespace App;

use App\Dish;
use App\Category;
use App\User;
use App\Order;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'address', 'email', 'telephone', 'description', 'img_cover', 'logo', 'allow_cash', 'delivery_cost', 'is_visible'
    ];

    public function dishes() {
        return $this -> hasMany(Dish::class);
    }

    public function categories() {
        return $this -> belongsToMany(Category::class);
    }

    public function user() {
        return $this -> belongsTo(User::class);
    }

    public function orders() {
        return $this -> hasMany(Order::class);
    }
}
