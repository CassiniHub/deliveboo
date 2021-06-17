<?php

namespace App;

use App\Restaurant;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'description', 'img_cover'
    ];

    public function restaurants() {
        return $this -> belongsToMany(Restaurant::class);
    }
}
