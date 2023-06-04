<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;


class CheckoutController extends Controller
{
    public function checkout() {

        $webhookUrl = route('webhooks.mollie');

        if(App::environment('local')) {
            $webhookUrl = 'https://483e-87-67-0-190.ngrok-free.app/webhooks/mollie';
        }

        // dd($webhookUrl);
        Log::alert('Before Mollie checkout, total price is calculated');
        
        $cart = Cart::session(3);
        $total = $cart->getTotal();
        $total = (string) number_format($total, 2, '.', '');
        // dd($webhookUrl);
        // $client = new GuzzleHttp\Client(['verify' => false]);
        $payment = Mollie::api()->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => $total // You must send the correct number of decimals, thus we enforce the use of strings
            ],
            "description" => "Bestelling op " . date('d-m-Y h:i'),
            "redirectUrl" => route('checkout.success'),
            "webhookUrl" => $webhookUrl,
            "metadata" => [
                "order_id" => "12345",
            ],
        ]);
        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function success() {
        return 'Jouw bestelling is goed binnengekomen!';
    }
}
