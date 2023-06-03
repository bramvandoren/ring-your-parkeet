<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function checkout() {

        $webhookUrl = route('webhooks.mollie');

        if(App::environment('local')) {
            $webhookUrl = 'https://f60f-2a02-a03f-f2cf-d600-f889-ce73-2c3f-5bb8.ngrok-free.app/webhooks/mollie';
        }
        Log::alert('Before Mollie checkout, total price is calculated');
        
        $cart = Cart::session(3);
        $total = $cart->getTotal();
        $total = number_format($total,2);
        // dd($webhookUrl);
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
