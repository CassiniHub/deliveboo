<?php

namespace App\Http\Controllers;

use App\Dish;
use App\Restaurant;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use App\Library\Helpers\MyValidation;

Use App\Library\Helpers\Images;
use Illuminate\Support\Facades\Storage;
use File;

class DishController extends Controller
{
    public function __construct()
    {
        $this -> middleware('auth') -> except(['show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.dishes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validateData = $request -> validate(MyValidation::validateDish());
        $dish         = Dish::make($validateData);

        $restaurant = Restaurant::findOrFail($request -> get('restaurant_id'));

        if ($request -> file('img')) {
            $image      = new Images;
            $imgNewName = $image -> getImgName($request, 'img');
            $folderPath = '/images/dishes';
            $storedImg  = ($request -> file('img'))
                -> storeAs($folderPath, $imgNewName, 'public');
            $dish -> img = $imgNewName;
        }

        $dish -> restaurant() -> associate($restaurant -> id);
        $dish -> save();

        return redirect() -> route('protectedRestaurant.show', $restaurant -> id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        //
    }
}
