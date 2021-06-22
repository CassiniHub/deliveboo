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

    public function indexTest($arr) {

        $jsonArray = json_decode($arr, true);
        $restaurants = null;

        for ($x=0; $x<count($jsonArray); $x++){
            $id = $jsonArray[$x];
            $restaurant = Restaurant::whereHas('categories', function($q) use ($id) {
                $q->where('category_id', $id);
            })->get();
            $restaurants[$x] = $restaurant;
        }

        return response() -> json($restaurants);
    }
}
