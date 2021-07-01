<?php

namespace App\Http\Controllers;

use App\Dish;
use App\Order;
use App\Restaurant;

use App\Library\Helpers\MyValidation;
use App\Mail\OrderConfirm;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
        
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function setSession(Request $request) {

        $ids_decoded = json_decode($request -> ids);
        session(['ids' => $ids_decoded]);
        return redirect() -> route('checkouts.index');
    }

    public function index()
    {
        $ids = session() -> get('ids');
        $ids_encoded = json_encode($ids);
        
        $totPrice = 0;

        foreach ($ids as $id) {
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
            'dishes_ids' => $ids_encoded
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

            // create order element in DB
            $validatedData = $request -> validate(MyValidation::validateOrder());
            $order = Order::make($validatedData);

            $order -> tot_price = $totPrice;
            $order -> status = 1;
            $order ->order_datetime = now();

            $dish = Dish::findOrFail($dishesIds_decoded[0]);
            $restaurant = Restaurant::findOrFail($dish ->restaurant_id);
            $order ->restaurant() ->associate($restaurant);

            $order -> save();

            foreach ($dishesIds_decoded as $id) {
                $order -> dishes() -> attach($id);
            }

            // send mail
            $mail = $order ->email;
            Mail::to($mail)
                ->send(new OrderConfirm($order, $restaurant));

            return redirect() -> route('checkouts.success', $order ->id);
        } else {
            $errorString = "";

            foreach($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
    
            // $_SESSION["errors"] = $errorString;
            // header("Location: " . $baseUrl . "index.php");
            return back() -> withErrors('An error occurred with the message' . $result -> message);
        }
    }

    public function success($id) {
        $order = Order::findOrFail($id);
        session() -> forget('ids');
        session() -> save();
        return view('pages.checkouts.success', compact('order'));
    }

    public function denied() {
        return view('pages.checkouts.denied');
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
