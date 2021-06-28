<?php

namespace App\Http\Controllers;

use App\Restaurant;
use App\Category;
use App\Dish;
use App\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use App\Library\Helpers\MyValidation;
Use App\Library\Helpers\Images;
use Illuminate\Support\Facades\Storage;
use File;



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
        $categories = Category::all();
        $restaurants = Restaurant::all();

        return view('pages.restaurants.index', compact(
            'categories',
            'restaurants'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('pages.restaurants.create', compact('categories'));
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
        $categories = $request ->get('category_id');
        
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
        $restaurant ->categories() ->attach($categories);
        return redirect() ->route('users.show', Auth::user() -> id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        return view('pages.restaurants.show', compact('restaurant'));
    }

    public function protectedShow($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $dishes = $restaurant ->dishes() ->orderBy('name') -> get();

        return view('pages.restaurants.protectedShow', compact('restaurant', 'dishes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        $categories = Category::all();

        return view('pages.restaurants.edit', compact(
            'restaurant',
            'categories'
        ));
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
        $validateData = $request -> validate(MyValidation::validateRestaurant());
        $categories = $request ->get('category_id');

        if ($restaurant ->img_cover) {
            $delete = new Images;
            $toDelete = $restaurant ->img_cover;
            $delete ->deleteRestaurantCover($toDelete);
        }

        if ($restaurant ->logo) {
            $delete = new Images;
            $toDelete = $restaurant ->logo;
            $delete ->deleteRestaurantLogo($toDelete);
        }

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

        $restaurant ->update($validateData);
        $restaurant ->categories() ->sync($categories);
        $restaurant ->save();

        return redirect() -> route('restaurants.protectedShow', $restaurant -> id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $restaurant = Restaurant::findOrFail($id);

        if ($restaurant ->img_cover) {
            $delete = new Images;
            $toDelete = $restaurant ->img_cover;
            $delete ->deleteRestaurantCover($toDelete);
        }

        if ($restaurant ->logo) {
            $delete = new Images;
            $toDelete = $restaurant ->logo;
            $delete ->deleteRestaurantLogo($toDelete);
        }

        $restaurant ->delete();
        return redirect() -> route('users.show', Auth::user() -> id);
    }

    public function protectedOrders($id) {

        $restaurant = Restaurant::findOrFail($id);
        $dishes = Dish::all() ->where('restaurant_id', $restaurant->id);
        $ordersArr = [];
        // DA SISTEMARE -> PUSHA ORDINI DOPPI   
        // foreach ($dishes as $dish) {
        //     foreach ($dish ->orders as $key => $order) {
        //         if (count($ordersArr) > 0) {

        //             for($i=0;$i<count($ordersArr);$i++)
        //                 if($order ->id == $ordersArr[$i] ->id){
        //                     $ordersArr[] = $order;
        //                 }
        //         }else{
        //             $ordersArr[] = $order;
        //         }
        //     }
        // }
        return view('pages.restaurants.protectedOrders', compact('restaurant', 'ordersArr'));
    }

    public function protectedStatistics($id) {

        $restaurant = Restaurant::findOrFail($id);

        return view('pages.restaurants.protectedStatistics', compact('restaurant'));
    }
}
