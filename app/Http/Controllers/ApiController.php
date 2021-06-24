<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use App\Category;

class ApiController extends Controller
{
    public function index($ids) {

        $ids_decoded = json_decode($ids,true);
            
            $restaurants = Restaurant::whereHas('categories', function($q) use ($ids_decoded) {
    
                $q->whereIn('category_id', $ids_decoded);
            }) -> get();

        return response() -> json($restaurants);
    }
}
