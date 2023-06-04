<?php

namespace App\Http\Controllers;


use App\Order;
use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;


class CheckoutController extends Controller
{
    public function checkout(Request $req) {

        //Info van shoppingcart
        $cart = Cart::session(3);
        $total = $cart->getTotal();
        // dd(auth()->user());
        //Maak nieuwe bestelling
        $order = new Order();
        $order->reference = auth()->user()->firstname; // Genereer een referentiecode of gebruik een andere methode om een unieke referentie te maken
        $order->status = 'pending...'; // Stel de juiste status in
        $order->total_price = $total; // Wordt later berekend op basis van de ontvangen producten
        $order->shipping_data = '...'; // Vul de juiste verzendgegevens in
        $order->payment_data = ".."; // Vul de juiste betalingsgegevens in
        $order->remarks = '...'; // Vul eventuele opmerkingen in
        $order->admin_remarks = '...'; // Vul eventuele opmerkingen voor de beheerder in
    
        $webhookUrl = route('webhooks.mollie');
        if(App::environment('local')) {
            $webhookUrl = 'https://483e-87-67-0-190.ngrok-free.app/webhooks/mollie';
        }

        Log::alert('Before Mollie checkout, total price is calculated');
        $total = (string) number_format($total, 2, '.', '');
        // $paymentId = $req->input('id');
        // $payment = Mollie::api()->payments()->get($req->json('id'));
        // dd($payment);
        $payment = Mollie::api()->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => $total // You must send the correct number of decimals, thus we enforce the use of strings
            ],
            "description" => "Bestelling op " . date('d-m-Y h:i'),
            "redirectUrl" => route('checkout.success'),
            "webhookUrl" => $webhookUrl,
            "metadata" => [
                "order_id" => $order->id,
                "order_from" => $order->name,
            ],
        ]);
    

        $order->save();

        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function success() {
        return 'Jouw bestelling is goed binnengekomen!';
    }
}
