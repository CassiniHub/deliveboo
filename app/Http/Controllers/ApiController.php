<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use App\Category;

class ApiController extends Controller
{
    public function index($id) {

        $restaurants = Restaurant::whereHas('categories', function($q) use ($id) {
            $q->where('category_id', $id);
         })->get();

        return response() -> json($restaurants);
    }
}
