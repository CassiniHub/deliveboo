<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'address', 'email', 'telephone', 'description', 'img_cover', 'logo', 'allow_cash', 'delivery_cost', 'is_visible'
    ];
}
