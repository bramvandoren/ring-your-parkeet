<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BestellingController;
use App\Models\Bestelling;
use App\Models\User;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Order;
use App\UserGroup;
use App\UserStatus;
use Illuminate\Support\Facades\App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
            // dd($userStatus);
            $lidgeldBetaald = $userStatus ? $userStatus->isPaid() : false;

            // Haal de usergroup van de gebruiker op
            $userGroup = UserGroup::find($user->group_id);
            $lidgeld = $userGroup ? $userGroup->price : 0;

            // Haal de bestellingen van de gebruiker op
            $bestellingen = Order::where('user_id', $user->id)->get();
            $cart = Cart::session(3);
    
            return view('dashboard.index', compact('user', 'bestellingen','menuItems', 'lidgeld', 'cart', 'lidgeldBetaald', 'userStatus'));
        }
    
        public function betalingLidgeld()
        { 
            //Info van shoppingcart
            $cart = Cart::session(3);
            $user = User::find(auth()->user()->id);

            //prijs ophalen van user group
            $userGroupPrice = $user->userGroup->price;

            //user group ophalen voor prijs
            $user_status = $user->userStatus;
            // dd(auth()->user()->id);
            // $userStatusId = UserStatus::with('userGroup')->get();

            //Maak nieuwe betaling
            // $betaling = new Order();
            // $order->user_id = auth()->id(); // Gebruik de juiste gebruikers-ID
            // $order->reference = auth()->user()->firstname; // Genereer een referentiecode of gebruik een andere methode om een unieke referentie te maken
            // $order->status = 'pending...'; // Stel de juiste status in
            // $order->total_price = $total; // Wordt later berekend op basis van de ontvangen producten
            // $order->shipping_data = '...'; // Vul de juiste verzendgegevens in
            // $order->payment_data = ".."; // Vul de juiste betalingsgegevens in
            // $order->remarks = '...'; // Vul eventuele opmerkingen in
            // $order->admin_remarks = '...'; // Vul eventuele opmerkingen voor de beheerder in
        
            $webhookUrl = route('webhooks.mollie');
            if(App::environment('local')) {
                $webhookUrl = 'https://483e-87-67-0-190.ngrok-free.app/webhooks/mollie';
            }

            $total = (string) number_format($userGroupPrice, 2, '.', '');

            $payment = Mollie::api()->payments->create([
                "amount" => [
                    "currency" => "EUR",
                    "value" => $userGroupPrice // You must send the correct number of decimals, thus we enforce the use of strings
                ],
                "description" => "Bestelling op " . date('d-m-Y h:i'),
                "redirectUrl" => route('dashboard.index'),
                "webhookUrl" => $webhookUrl,
                "metadata" => [
                    "user_status" => $user->userStatus->status,
                    "order_from" => auth()->user()->firstname . " " . auth()->user()->lastname,
                ],
            ]);
        
    
            // $order->save();
    
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

        public function detailBestelling($id)
        {
            $bestelling = Order::findOrFail($id);
            $bestellingenDetail = $bestelling->bestellingenDetail;
            $cart = Cart::session(3);
            return view('dashboard.edit', compact('cart', 'bestelling', 'bestellingenDetail'));
        }
        public function verwijderBestelling(Order $bestelling)
        {
            // Voer hier de logica uit om de bestelling te verwijderen

            // Bijvoorbeeld:
            $bestelling->delete();

            return redirect()->route('dashboard.index')->with('success', 'Bestelling verwijderd.');
        }
        public function success(Request $req)
        {
            $cart = Cart::session(3);

            // Keer terug naar de succes-pagina met de gegevens van de bestelling
            return view('dashboard.index', compact('cart'));
        }
}
