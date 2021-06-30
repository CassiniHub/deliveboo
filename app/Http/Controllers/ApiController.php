<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Restaurant;
use App\Category;

class ApiController extends Controller
{
    public function index($ids) {

        $ids_decoded = json_decode($ids,true);

        $query = new Restaurant;

        foreach($ids_decoded as $id_decoded) {
            $query = $query -> with('categories') -> whereHas('categories', function($q) use($id_decoded){
                $q -> where('category_id', $id_decoded);
            });
        }

        $restaurants = $query -> get();

        return response() -> json($restaurants);
    }
}