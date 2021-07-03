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

    // Make security checks and set the dishes ids and restaurant id as sessions variables
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

    // Checkout form page
    public function index()
    {
        // Check if the dishes_ids session variables exist
        // if not, redirect to homepage
        // Do this to avoid the possibility to encounter errors in case of copy / paste url
        if (!session() -> has('dishes_ids')) {
            return redirect() -> route('restaurants.index');
        }

        $restaurant_id = session() -> get('restaurant_id');
        $dishes_ids    = session() -> get('dishes_ids');

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
    
    // Make the transaction and redirect to the right summary order view
    // @param {$totPrice} totPrice cart coming from index
    // @param {$dishes_ids} dishes ids coming from index instead of session to speed up the code
    //                      ids used to create order to insert into DB
    public function transaction (Request $request, $totPrice, $dishes_ids)
    {
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

        // Decodes ids to use to create order and send mails at the end of the transaction
        $dishes_ids_decoded = json_decode($dishes_ids);

        if ($result->success) {
            // Check the line - Probably useless
            // $transaction = $result->transaction;

            // create order row in DB
            $validatedData = $request -> validate(MyValidation::validateOrder());
            $order         = Order::make($validatedData);

            $order -> tot_price      = $totPrice;
            $order -> status         = 1;
            $order -> order_datetime = now();

            // Get the the of the given dish id
            // Get the linked restaurant and associate to the order
            $dish              = Dish::findOrFail($dishes_ids_decoded[0]);
            $restaurant        = Restaurant::findOrFail($dish ->restaurant_id);
            $order -> restaurant() -> associate($restaurant);
            $order -> save();

            foreach ($dishes_ids_decoded as $id) {
                $order -> dishes() -> attach($id);
            }

            // Send order success mail
            $mail = $order -> email;
            Mail::to($mail)
                ->send(new OrderConfirm($order, $restaurant));

            return redirect() -> route('checkouts.success', $order ->id);
        } else {
            $dish       = Dish::findOrFail($dishes_ids_decoded[0]);
            $restaurant = Restaurant::findOrFail($dish ->restaurant_id);

            // Send order failed mail
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

    // - - - - - - - - - - - - - - - - - - - - - - - - -

    // After trasaction goes well to return the summary 
    // success order page and restore session data
    // @param {id} Id used to get all order information showed on the summary view
    public function success($id) {
        $order = Order::findOrFail($id);
        session() -> forget('ids');
        session() -> forget('id_restaurant');
        session() -> save();
        
        return view('pages.checkouts.success', compact('order'));
    }

    // View returned after transaction goes bad
    public function failed() {
        return view('pages.checkouts.failed');
    }

    // Restore session value after transaction goes bad
    public function restoreSession() {
        session() -> forget('ids');
        session() -> forget('id_restaurant');
        session() -> save();

        return route('hoempage');
    }
}