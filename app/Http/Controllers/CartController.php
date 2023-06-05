<?php
namespace App\Http\Controllers;

use App\Ring;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $menuItems = $this->menuItems;
        $menuItems[1]['active'] = true;
        // Hier kun je de winkelwagengegevens ophalen en doorgeven aan de view
        // $cartItems = session()->get('cart') ?? [];
        $vogelringen = Ring::with('type')->get();
        $cart = Cart::session(3);
        // dd($cart->getContent());
        return view('cart.index', compact('menuItems', 'cart', 'vogelringen'));
    }

    public function addToCart(Request $request)
    {

        // add a ring to the cart
        $ringId = $request->input("button_id");
        $amount = $request->input($ringId);
         // Haal het type van de ring op
        $ring = Ring::find($ringId);
        $type = $ring->type()->first();

        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if(!$cart) {
            $cart = [
                    $ringId => [
                        "name" => $ring->name,
                        "size" => $ring->size,
                        "quantity" => $amount,
                        "ring_price" => $ring->price,
                        "price" => $ring->price * $amount,
                        "id" => $ring->id,
                        'attributes' => [
                            'type' => $type, // Gebruik het type van de ring
                            // Voeg andere attributen toe indien nodig
                        ]
                    ]
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$ringId])) {
            $cart[$ringId]['quantity'] = $cart[$ringId]['quantity'] + $amount;
            $cart[$ringId]['price'] = $cart[$ringId]['quantity'] + $amount * $ring->price;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        // if item not exist in cart then add to cart without deleting existing data
        $cart[$ringId] = [
            "name" => $ring->name,
            "size" => $ring->size,
            "quantity" => $amount,
            "ring_price" => $ring->price,
            "price" => $ring->price * $amount,
            "id" => $ring->id,
        ];
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
        
    }

    public function update(Request $request)
{
    $itemIds = $request->input('item_id');
    $quantities = $request->input('aantal');

    foreach ($itemIds as $index => $itemId) {
        $quantity = (int) $quantities[$index];
        // dd($quantity);
        if ($quantity > 0) {
            Cart::session(3)->update($itemId, [
                'quantity' => array (
                    'relative' => false ,
                    'value' => $quantity
               ),
            ]);
        } else {
            Cart::session(3)->remove($itemId);
        }
    }

    return redirect()->back();
}


    public function removeFromCart($productId)
    {
        // Hier kun je de logica implementeren om een item uit de winkelwagen te verwijderen

        // Verwijder het item uit de winkelwagen

        return redirect()->route('cart')->with('success', 'Item is verwijderd uit de winkelwagen.');
    }

    public function checkout(Request $request)
    {
        // Hier kun je de logica implementeren voor het afrekenen van de winkelwagen

        // Verwerk de betaling en andere vereiste acties voor het afrekenen

        // Maak de winkelwagen leeg

        return redirect()->route('cart')->with('success', 'Afrekenen is voltooid.');
    }
}
