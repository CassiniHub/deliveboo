<?php

namespace App\Http\Controllers;

use App\Dish;
use App\Order;
use App\Restaurant;

use App\Library\Helpers\MyValidation;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
        
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($dishesIds)
    {
        $dishesIds_decoded = json_decode($dishesIds);
        $totPrice = 0;

        foreach ($dishesIds_decoded as $id) {
            $dish = Dish::findOrFail($id);
            $totPrice += $dish -> price;
        }

        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId'  => config('services.braintree.merchantId'),
            'publicKey'   => config('services.braintree.publicKey'),
            'privateKey'  => config('services.braintree.privateKey')
        ]);
    
        $token = $gateway->ClientToken()->generate();
        return view('pages.checkouts.index', [
            'token'    => $token,
            'totPrice' => $totPrice,
            'dishes_ids' => $dishesIds
        ]);
    }

    public function transaction (Request $request, $totPrice, $dishes_ids) {
        $dishesIds_decoded = json_decode($dishes_ids);
        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId'  => config('services.braintree.merchantId'),
            'publicKey'   => config('services.braintree.publicKey'),
            'privateKey'  => config('services.braintree.privateKey')
        ]);
    
        $amount = $totPrice;
        $nonce  = $request  -> payment_method_nonce;
    
        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);
        
        if ($result->success) {
            
            
            $transaction = $result->transaction;
            // header("Location: " . $baseUrl . "transaction.php?id=" . $transaction->id);

            $validatedData = $request -> validate(MyValidation::validateOrder());
            $order = Order::make($validatedData);

            $order -> tot_price = $totPrice;
            $order -> status = 1;

            $dish = Dish::findOrFail($dishesIds_decoded[0]);
            $restaurant = Restaurant::findOrFail($dish ->restaurant_id);
            $order ->restaurant() ->associate($restaurant);

            $order -> save();

            foreach ($dishesIds_decoded as $id) {
                $order -> dishes() -> attach($id);
            }
            
            return back() -> with('success_message', 'Transaction successful. The ID is:' . $transaction -> id);
        } else {
            $errorString = "";

            dd('dioporco');

            foreach($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
    
            // $_SESSION["errors"] = $errorString;
            // header("Location: " . $baseUrl . "index.php");
            return back() -> withErrors('An error occurred with the message' . $result -> message);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
