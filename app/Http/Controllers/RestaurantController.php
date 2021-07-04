<?php

namespace App\Http\Controllers;

use App\Restaurant;
use App\Category;
use App\Dish;
use App\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Use App\Library\Helpers\MyValidation;
Use App\Library\Helpers\CheckFormData;

use File;
Use App\Library\Helpers\Images;
use Illuminate\Support\Facades\Storage;

use App\Mail\RestaurantCreated;
use App\Mail\RestaurantRemoved;
use Illuminate\Support\Facades\Mail;





class RestaurantController extends Controller
{
    public function __construct()
    {
        $this -> middleware('auth') -> except(['index', 'show', 'getOrders', 'getOrdersYears', 'getOrderDishes']);
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
        // check phone number
        $telephone_check = new CheckFormData;
        if ($telephone_check -> checkPhoneNumber($request)) {
            return $telephone_check -> checkPhoneNumber($request);
        }
        
        // check categories array
        $categories = $request ->category_id;
        $allCateogories = Category::all();
        if(!$categories){
            
            return back() ->withErrors('Devi selezionare almeno una cateogoria per il tuo ristorante');
        }else{
            foreach ($categories as $category) {
                if ($category > count($allCateogories)){
                    return back() ->withErrors('Devi selezionare almeno una cateogoria per il tuo ristorante');
                }
            }
        }

        // Check if in a text input field the user is using a special banned char
        $special_char_check = new CheckFormData;
        $fields_to_check    = CheckFormData::restaurantsTextFields();
        $text_fields_values = $special_char_check -> getTextFieldsValues($fields_to_check, $request);
        if ($special_char_check -> checkSpecialChar($text_fields_values)) {
            return $special_char_check -> checkSpecialChar($text_fields_values);
        }

        $validateData = $request ->validate(MyValidation::validateRestaurant());
        $restaurant = Restaurant::make($validateData);
        $categories = $request ->get('category_id');
        
        if ($request ->file('img_cover')) {
            $image = new Images;
            $coverImgNewName = $image->getImgName($request - 'img_cover');
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

        // send confirmation mail
        $mail = Auth::user() ->email;
        Mail::to($mail)
        ->send(new RestaurantCreated($restaurant));

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
        $dishes = $restaurant ->dishes() ->get();
        $getTypes = [];
        $allTypes = ['contorni', 'insalate', 'primi', 'secondi', 'pizze', 'panini', 'dolci'];

        foreach ($dishes as $dish) {
            if(!in_array($dish ->type, $getTypes)){
                $getTypes[] = $dish ->type;
            }
        }

        // sort array to always get same types order
        $missingTypes = array_diff($allTypes, $getTypes);
        $types = array_diff($allTypes, $missingTypes);
        
        return view('pages.restaurants.show', compact('restaurant', 'dishes', 'types'));
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
        // check phone number
        $telephone_check = new CheckFormData;
        if ($telephone_check -> checkPhoneNumber($request)) {
            return $telephone_check -> checkPhoneNumber($request);
        }
        
        // check categories array
        $categories = $request ->category_id;
        $allCateogories = Category::all();
        if(!$categories){
            
            return back() ->withErrors('Devi selezionare almeno una cateogoria per il tuo ristorante');
        }else{
            foreach ($categories as $category) {
                if ($category > count($allCateogories)){
                    return back() ->withErrors('Devi selezionare almeno una cateogoria per il tuo ristorante');
                }
            }
        }
        
        // Check if in a text input field the user is using a special banned char
        $special_char_check = new CheckFormData;
        $fields_to_check    = CheckFormData::restaurantsTextFields();
        $text_fields_values = $special_char_check -> getTextFieldsValues($fields_to_check, $request);
        if ($special_char_check -> checkSpecialChar($text_fields_values)) {
            return $special_char_check -> checkSpecialChar($text_fields_values);
        }

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
        $removedRestaurant = $restaurant;

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

        // send confirmation mail
        $mail = Auth::user() ->email;
        Mail::to($mail)
        ->send(new RestaurantRemoved($removedRestaurant));

        return redirect() -> route('users.show', Auth::user() -> id);
    }

    public function protectedOrders($id) {

        $restaurant = Restaurant::findOrFail($id);
        $orders = $restaurant -> orders() ->orderBy('order_datetime', 'DESC') -> get();
        return view('pages.restaurants.protectedOrders', compact('restaurant', 'orders'));
    }

    public function protectedStatistics($id) {

        $restaurant = Restaurant::findOrFail($id);
        $orders = $restaurant -> orders() -> get();

        return view('pages.restaurants.protectedStatistics', compact('restaurant', 'orders'));
    }

    public function getOrders($id) {

        $restaurant = Restaurant::findOrFail($id);
        $orders = $restaurant ->orders() -> orderBy('order_datetime', 'ASC') ->get();

        return response() ->json($orders);
    }

    public function getOrdersYears($id, $year){

        $restaurant = Restaurant::findOrFail($id);
        $orders = $restaurant ->orders() 
                              ->whereYear('order_datetime', $year)
                              ->orderBy('order_datetime','ASC')
                              ->get();
        
        return response() ->json($orders);
    }

    public function getOrderDishes($id) {

        $restaurant = Restaurant::findOrFail($id);
        $orders = $restaurant ->orders() ->get();

        $dishes = [];

        foreach ($orders as $order) {
            foreach ($order ->dishes as $dish) {
            $dishes[] = $dish;
            }
        }

        return response() ->json($dishes);
    }

    public function changeVisibility($id) {
        $restaurant = Restaurant::findOrFail($id);
        if ($restaurant ->is_visible){
            $restaurant ->is_visible = false;
            $restaurant ->save();
        }else{
            $restaurant ->is_visible = true;
            $restaurant ->save();
        }

        return redirect() ->route('restaurants.protectedShow', $restaurant ->id);
    }
}
