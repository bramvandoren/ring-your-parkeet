<?php

namespace App\Http\Controllers;

use App\Ring;
use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Order;
use App\Type;

class BestellingController extends Controller
{
    public function index()
    {
        $menuItems = $this->menuItems;
        $menuItems[1]['active'] = true;

        $vogelringen = Ring::all();
        $cart = Cart::session(3);
        $verzendKosten = '6.50';
        return view('order.index', compact('menuItems', 'vogelringen', 'verzendKosten', 'cart'));
    }

    public function bestellenRingen(Request $request)
    {
        // Valideer de ingediende data
        $validatedData = $request->validate([
            'inwendige_maat' => 'required',
            'dikte' => 'required',
            'hoogte' => 'required',
            'prijs' => 'required',
            'aantal' => 'required|integer|min:1',
        ]);

        // Maak een nieuwe bestelling
        $bestelling = new Order();
        $bestelling->inwendige_maat = $validatedData['inwendige_maat'];
        $bestelling->dikte = $validatedData['dikte'];
        $bestelling->hoog = $validatedData['hoog'];
        $bestelling->aantal = $validatedData['aantal'];
        // Voeg eventueel extra logica toe aan de bestelling, zoals het berekenen van de prijs, etc.

        // Sla de bestelling op in de database
        $bestelling->save();
        // Markeer de bestelstatus van de ringen voor de ingelogde gebruiker
        // $user = auth()->user();
        // $user->ringenBestelstatus = 'Besteld bij leverancier';
        // $user->save();

        return redirect()->route('dashboard.index')->with('success', 'Ringen succesvol besteld.');
    }
    public function store(Request $request)
    {
        // Valideer het ontvangen verzoek

        $orderData = $request->validate([
            'products' => 'required|array',
            'products.*.aantal' => 'required|integer|min:1',
            'products.*.prijs' => 'required|numeric|min:0',
        ]);

        // Maak een nieuwe bestelling aan in de database

        $order = new Order();
        $order->user_id = auth()->id(); // Gebruik de juiste gebruikers-ID
        $order->reference = '...'; // Genereer een referentiecode of gebruik een andere methode om een unieke referentie te maken
        $order->status = 'new'; // Stel de juiste status in
        $order->total_price = 0; // Wordt later berekend op basis van de ontvangen producten
        $order->shipping_data = '...'; // Vul de juiste verzendgegevens in
        $order->payment_data = '...'; // Vul de juiste betalingsgegevens in
        $order->remarks = '...'; // Vul eventuele opmerkingen in
        $order->admin_remarks = '...'; // Vul eventuele opmerkingen voor de beheerder in
        $order->save();

        // Voeg de ontvangen producten toe aan de bestelling

        $totalPrice = 0;

        foreach ($orderData['products'] as $productData) {
            $typeId = $productData['type_id'];
            $aantal = $productData['aantal'];
            $prijs = $productData['prijs'];
            $subTotaal = $aantal * $prijs;
            $totalPrice += $subTotaal;
        
            // Voeg het product toe aan de bestelling (eventueel met extra gegevens zoals SKU, productnaam, etc.)
            $product = Type::join('rings', 'types.id', '=', 'rings.type_id')
            ->where('rings.type_id', '1')
            ->select('types.name as type_name')
            ->first();

            $naam = $product->type_name;

        
            $order->products()->attach($product->id, ['naam' => $naam, 'aantal' => $aantal, 'prijs' => $prijs]);
        }
        
        // Werk de totaalprijs van de bestelling bij
        $order->total_price = $totalPrice;
        $order->save();

        // Retourneer een JSON-respons met de gegevens van de opgeslagen bestelling

        return response()->json($order);
    }

}
