<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalController extends Controller
{
    //
    function index() {
        return view('index');
    }

    function paypal(Request $req){
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $data = [
            'application_context' => [
                'return_url' => url('/success'),
                'cancel_url' => url('/cancel'),
            ],
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => $req->price
                    ]
                ]
            ]
        ];

        try {
            // Make the API call to create an order
            $response = $provider->createOrder($data);
            
            // Check if the response was successful
            if (isset($response['id']) && $response['id'] !== '') {
                // Redirect to the PayPal approval URL
                foreach($response['links'] as $link){
                    if($link['rel'] === 'approve'){
                        return redirect()->away($link['href']);
                    }
                }                
            } else {
                // Handle errors or unexpected response
                dd($response); 
            }
        } catch (\Exception $e) {
            // Handle any exceptions
            dd($e->getMessage()); 
        }
    }

    function pay(Request $req){
        dd($req->all());
    }

    function success(Request $req){
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($req->token);
        dd($response);
    }

    function cancel(){
        dd("failed");
    }

}
