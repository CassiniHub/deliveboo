<?php

namespace App\Http\Controllers;

use App\Restaurant;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use App\Library\Helpers\MyValidation;
Use App\Library\Helpers\Images;
use Illuminate\Support\Facades\Storage;


class RestaurantController extends Controller
{
    public function __construct()
    {
        $this -> middleware('auth') -> except(['index', 'show']);
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
        return view('pages.restaurants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validateData = $request ->validate(MyValidation::validateRestaurant());
        $restaurant = Restaurant::make($validateData);
        
        if ($request ->file('img_cover')) {
            $image = new Images;
            $coverImgNewName = $image->getImgName($request, 'img_cover');
            $folderPath = '/images/restaurants/cover';
            $storedImg = ($request ->file('img_cover')) 
                ->storeAs($folderPath, $coverImgNewName, 'public');
            $restaurant ->img_cover = $coverImgNewName;
        }
        if ($request ->file('logo')) {
            $image = new Images;
            $logoimgNewName = $image->getImgName($request, 'logo');
            $folderPath = '/images/restaurants/logo';
            $storedImg = ($request ->file('logo')) 
                ->storeAs($folderPath, $logoimgNewName, 'public');
            $restaurant ->logo = $logoimgNewName;
        }
            
        $restaurant ->user() ->associate(Auth::user() ->id);
        $restaurant ->save();
        return redirect() ->route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        //
    }
}
