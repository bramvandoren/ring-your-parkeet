<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BestellingController;
use App\Models\Bestelling;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Order;
use App\UserStatus;
use Illuminate\Support\Facades\App;

use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie;

class LedenDashboardController extends Controller
   

    {
        public function index()
        {
            $menuItems = $this->menuItems;
            $menuItems[1]['active'] = true;
            // Haal de ingelogde gebruiker op
            $user = auth()->user();
            // dd($user);
            $userStatus = UserStatus::where('user_id', $user->id)->first();

            $lidgeldBetaald = $userStatus ? $userStatus->isPaid() : false;
            // Definieer hoeveel lidgeld
            $lidgeld = 50;

            // Haal de bestellingen van de gebruiker op
            $bestellingen = Order::where('user_id', $user->id)->get();
            $cart = Cart::session(3);
    
            return view('dashboard.index', compact('user', 'bestellingen','menuItems', 'lidgeld', 'cart', 'lidgeldBetaald'));
        }
    
        public function betalingLidgeld(Request $req)
        {
            
    
            $amount = 50;
            // add to decimals and convert to string
            $amount = (string) number_format($amount, 2, '.', '');
            $webhookUrl = route('webhooks.mollie');

            if(App::environment('local')) {
                $webhookUrl = 'https://483e-87-67-0-190.ngrok-free.app/webhooks/mollie';
            }
            $payment = Mollie::api()->payments->create([
                "amount" => [
                    "currency" => "EUR",
                    "value" => "10.00" // You must send the correct number of decimals, thus we enforce the use of strings
                ],    
                "description" => "Order #12345",
                "redirectUrl" => route('rich.thanks'),
                "webhookUrl" => $webhookUrl,
                "metadata" => [
                    "order_id" => "12345",
                ],
            ]);
    
            return redirect($payment->getCheckoutUrl(), 303);
            
            // Markeer het lidgeld als betaald voor de ingelogde gebruiker
            // $user = auth()->user();
            // $userStatus = UserStatus::where('user_id', $user->id)->first();

            // if ($userStatus) {
            //     $userStatus->status = 'betaald';
            //     $userStatus->save();
            // }
    
            // return redirect()->route('dashboard.index')->with('success', 'Lidgeld succesvol betaald.');
        }

        public function showRingenBestellenForm()
        {
            return view('dashboard.bestelling');
        }
    
        public function bestellenRingen(Request $request)
        {
            // Valideer het ringenbestelformulier
            $request->validate([
                // Voeg hier eventuele validatieregels toe
            ]);

            // Plaats hier de logica voor het bestellen van ringen
            // Maak een nieuwe bestelling aan voor de ingelogde gebruiker
            $user = auth()->user();
            $order = new Order();
            $order->user_id = $user->id;
            $order->status = 'Besteld bij leverancier';
            $order->save();
            // Markeer de bestelstatus van de ringen voor de ingelogde gebruiker
            // $user = auth()->user();
            // $user->ringenBestelstatus = 'Besteld bij leverancier';
            // $user->save();
    
            return redirect()->route('dashboard.index')->with('success', 'Ringen succesvol besteld.');
        }
        public function annuleerBestelling(Order $bestelling)
        {
            // Voer hier de logica uit om de bestelling te annuleren

            // Bijvoorbeeld:
            $bestelling->status = 'Geannuleerd';
            $bestelling->save();

            return redirect()->route('dashboard.index')->with('success', 'Bestelling geannuleerd.');
        }
        public function verwijderBestelling(Order $bestelling)
        {
            // Voer hier de logica uit om de bestelling te verwijderen

            // Bijvoorbeeld:
            $bestelling->delete();

            return redirect()->route('dashboard.index')->with('success', 'Bestelling verwijderd.');
        }
}
