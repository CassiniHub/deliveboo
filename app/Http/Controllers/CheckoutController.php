<?php

namespace App\Http\Controllers;

use App\Dish;
use App\Order;
use App\Restaurant;

use App\Library\Helpers\MyValidation;
use App\Library\Helpers\BraintreeHelpers;

use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirm;
use App\Mail\OrderFailed;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
        
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function setSession(Request $request)
    {
        // Check if dishes ids coming from request are an array of integer or not
        $dishes_ids_decoded = json_decode($request -> ids);
        if (is_array($dishes_ids_decoded)) {
            foreach ($dishes_ids_decoded as $dish_id_decoded) {
                if (!is_int($dish_id_decoded)) {
                    return redirect() -> route('restaurants.index');
                }
            }
        } else {
            return redirect() -> route('restaurants.index');
        } 

        // Check if restaurant id coming from the request is an integer or not
        $restaurant_id = json_decode($request -> r_id);
        if (!is_int($restaurant_id)) {
            return redirect() -> route('restaurants.index');
        }

        // Set restaurant id and dishes ids as session variables to use in index function
        session([
            'dishes_ids' => $dishes_ids_decoded,
            'restaurant_id' => $restaurant_id
        ]);

        return redirect() -> route('checkouts.index');
    }

    // - - - - - - - - - - - - - - - - - - - - - - - - -

    public function index()
    {
        // Check if the dishes_ids session variables exist
        // if not, redirect to homepage
        // Do this to avoid the possibility to encounter errors in case of copy / paste url
        if (!session() -> has('dishes_ids')) {
            return redirect() -> route('restaurants.index');
        }

        $restaurant_id      = session() -> get('restaurant_id');
        $dishes_ids         = session() -> get('dishes_ids');

        // Calc the cart tot price
        $totPrice = 0;

        // Get every dish from DB using the array of index coming from session variable
        foreach ($dishes_ids as $dish_id) {
            $dish = Dish::findOrFail($dish_id);
            // Check if every dish is from the same restaurant
            if ($dish -> restaurant_id == $restaurant_id) {
                $totPrice += $dish -> price;
            } else {
                return redirect() -> route('restaurants.index');
            }
        }

        // Add delivery cost
        $restaurant     = Restaurant::findOrFail($restaurant_id);
        $delivery_cost  = $restaurant -> delivery_cost;
        $totPrice      += $delivery_cost;

        // Braintree generate user transaction token to make the payment
        $gateway            = new \Braintree\Gateway(BraintreeHelpers::config());
        $token              = $gateway -> ClientToken() -> generate();
        $dishes_ids_encoded = json_encode($dishes_ids);

        return view('pages.checkouts.index', [
            'token'    => $token,
            'totPrice' => $totPrice,
            'dishes_ids' => $dishes_ids_encoded
        ]);
    }

    // - - - - - - - - - - - - - - - - - - - - - - - - -
    
    public function transaction (Request $request, $totPrice, $dishes_ids)
    {
        $dishesIds_decoded = json_decode($dishes_ids);
        $gateway           = new \Braintree\Gateway(BraintreeHelpers::config());
        $amount            = $totPrice;
        $nonce             = $request  -> payment_method_nonce;
        $result            = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);
        if ($result->success) {
            $transaction = $result->transaction;

            // create order element in DB
            $validatedData = $request -> validate(MyValidation::validateOrder());
            $order         = Order::make($validatedData);

            $order -> tot_price      = $totPrice;
            $order -> status         = 1;
            $order -> order_datetime = now();

            $dish       = Dish::findOrFail($dishesIds_decoded[0]);
            $restaurant = Restaurant::findOrFail($dish ->restaurant_id);
            $order ->restaurant() -> associate($restaurant);
            $order -> save();

            foreach ($dishesIds_decoded as $id) {
                $order -> dishes() -> attach($id);
            }

            // send mail
            $mail = $order -> email;
            Mail::to($mail)
                ->send(new OrderConfirm($order, $restaurant));

            return redirect() -> route('checkouts.success', $order ->id);
        } else {
            $dish       = Dish::findOrFail($dishesIds_decoded[0]);
            $restaurant = Restaurant::findOrFail($dish ->restaurant_id);

            // send mail
            $mail = $request -> email;
            Mail::to($mail)
                ->send(new OrderFailed($restaurant));
            
            // Create error string to display
            $errorString = "";
            foreach($result -> errors -> deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }

            return redirect() -> route('checkouts.failed') -> withErrors('An error occurred with the message' . $result -> message);
        }
    }

    public function success($id) {
        $order = Order::findOrFail($id);
        session() -> forget('ids');
        session() -> forget('id_restaurant');
        session() -> save();
        
        return view('pages.checkouts.success', compact('order'));
    }

    public function failed() {
        return view('pages.checkouts.failed');
    }

    public function restoreSession() {
        session() -> forget('ids');
        session() -> forget('id_restaurant');
        session() -> save();

        return route('hoempage');
    }
}