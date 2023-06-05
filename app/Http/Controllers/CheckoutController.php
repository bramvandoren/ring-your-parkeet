<?php

namespace App\Http\Controllers;


use App\Order;
use App\OrdersItem;
use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Mail\OrderPlaced;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationEmail;



class CheckoutController extends Controller
{
    public function checkout(Request $req) {

        //Info van shoppingcart
        $cart = Cart::session(3);
        $total = $cart->getTotal();
        // dd(auth()->user());
        //Maak nieuwe bestelling
        $order = new Order();
        $order->user_id = auth()->id(); // Gebruik de juiste gebruikers-ID
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
                "order_from" => auth()->user()->firstname . auth()->user()->lastname,
            ],
        ]);
    

        $order->save();

        // Maak orderitems aan en sla ze op in de database
        foreach ($cart->getContent() as $item) {
            $orderItem = new OrdersItem();
            $orderItem->order_id = $order->id; // Koppel het orderitem aan de bestelling
            $orderItem->ring_id = $item->id; // Vervang dit met de juiste kolomnaam voor de ring_id
            $orderItem->amount = $item->quantity; // Vervang dit met de juiste kolomnaam voor de amount
            $orderItem->ring_codes = '...'; // Vul de juiste ringcodes in
            $orderItem->ring_data = '...'; // Vul de juiste ringdata in
            $orderItem->save();
        }


        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function success(Request $req)
    {
        // Maak cart leeg
        $cart = Cart::session(3);
        Cart::clear();
        Cart::session(3)->clear();

        // // Verstuur de e-mail
        // $email = auth()->user()->email;
        // $this->sendOrderConfirmationEmail($email);

        // Keer terug naar de succes-pagina met de gegevens van de bestelling
        return view('checkout.success', compact('cart'));
    }
    // public function sendOrderConfirmationEmail(Order $order)
    // {
    //     // Verstuur de orderbevestigingsmail naar de klant
    //     Mail::to($order->email)->send(new OrderConfirmationEmail($order));

    //     // Eventuele andere logica of acties na het verzenden van de e-mail

    //     return redirect()->back()->with('success', 'Orderbevestigingsmail is verzonden.');
    // }
}
