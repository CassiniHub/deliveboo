<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'ingredients', 'price', 'discount', 'img', 'type', 'is_visible'
    ];
}
