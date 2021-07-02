<?php

namespace App\Http\Controllers;

use App\Dish;
use App\Restaurant;

use Illuminate\Http\Request;
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
    }

    public function createDish($id) {

        $restaurant = Restaurant::findOrFail($id);

        return view('pages.dishes.create', compact('restaurant'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    public function storeDish(Request $request, $id) {

        // check textarea
        $dangerChars = ['{', '}', '>', '<', '[', ']', '=', '+', '&', '$', '#'];
        $checkStr = $request ->ingredients;
        foreach ($dangerChars as $char) {
            if (strpos($checkStr, $char)){
                return back() ->withErrors('La lista di ingredienti non può contenere i seguenti caratteri: { } > < [ ] = + & $ #');
            }
        }

        // test dish type
        $acceptedTypes = ['contorni', 'insalate', 'primi', 'secondi', 'pizze', 'panini', 'dolci']; 
        $selType = $request ->type;
        $found = false;
        foreach ($acceptedTypes as $type) {
            if ($type == $selType){
                $found = true;
            }
        }
        if (!$found || !$selType) {
            return back() ->withErrors('Devi selezionare una tipologia tra quelle proposte');
        }

        $validateData = $request -> validate(MyValidation::validateDish());
        $dish         = Dish::make($validateData);
        
        $restaurant = Restaurant::findOrFail($id);

        if ($request -> file('img')) {
            $image      = new Images;
            $imgNewName = $image -> getImgName($request, 'img');
            $folderPath = '/images/dishes';
            $storedImg  = ($request -> file('img'))
            -> storeAs($folderPath, $imgNewName, 'public');
            $dish -> img = $imgNewName;
        }
        
        $dish -> restaurant() -> associate($restaurant);
        $dish -> save();

        return redirect() -> route('restaurants.protectedShow', $restaurant -> id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
        return view('pages.dishes.show', $dish -> id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        return view('pages.dishes.edit', compact(
            'dish'
        ));
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
        // check textarea
        $dangerChars = ['{', '}', '>', '<', '[', ']', '=', '+', '&', '$', '#'];
        $checkStr = $request ->ingredients;
        foreach ($dangerChars as $char) {
            if (strpos($checkStr, $char)){
                return back() ->withErrors('La lista di ingredienti non può contenere i seguenti caratteri: { } > < [ ] = + & $ #');
            }
        }

        // test dish type
        $acceptedTypes = ['contorni', 'insalate', 'primi', 'secondi', 'pizze', 'panini', 'dolci']; 
        $selType = $request ->type;
        $found = false;
        foreach ($acceptedTypes as $type) {
            if ($type == $selType){
                $found = true;
            }
        }
        if (!$found || !$selType) {
            return back() ->withErrors('Devi selezionare una tipologia tra quelle proposte');
        }

        $validateData = $request -> validate(MyValidation::validateDish());

        if ($request -> file('img')) {

            $delete   = new Images;
            $toDelete = $dish -> img;
            $delete -> deleteDishImg($toDelete);

            $image      = new Images;
            $imgNewName = $image -> getImgName($request, 'img');
            $folderPath = '/images/dishes';
            $storedImg  = ($request -> file('img'))
                -> storeAs($folderPath, $imgNewName, 'public');

            $dish -> img = $imgNewName;
        }

        $dish -> update($validateData);

        return redirect() -> route('restaurants.protectedShow', $dish -> restaurant_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {

        if ($dish -> img) {
            $delete   = new Images;
            $toDelete = $dish -> img;
            $delete -> deleteDishImg($toDelete);
        }
        
        $dish -> delete();
        return redirect()->back();
    }

    public function changeVisibility($id) {
        $dish = Dish::findOrFail($id);
        if ($dish ->is_visible){
            $dish ->is_visible = false;
            $dish ->save();
        }else{
            $dish ->is_visible = true;
            $dish ->save();
        }

        return redirect() ->route('restaurants.protectedShow', $dish ->restaurant_id);
    }
}
