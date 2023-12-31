<?php

namespace App\Http\Controllers;
use App\Ring;
use App\Type;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Http\Request;

class RingController extends Controller
{
    public function index(Request $request)
    {
        $menuItems = $this->menuItems;
        $menuItems[1]['active'] = true;
        // Hier kun je de winkelwagengegevens ophalen en doorgeven aan de view
        // $cartItems = session()->get('cart') ?? [];
        $vogelringen = Ring::with('type')->get();
        // $kleurVogelringen = Ring::with('type')->whereHas('type', function ($query) {
        //     $query->where('Standaard aluminium vogelringen')->get();
        // $inoxVogelringen = Ring::with('type')->where('type', 'Standaard RVS Ringen')->get();
        $kleurVogelringen = Ring::with('type')->whereHas('type', function ($query) {
            $query->where('name', 'Standaard aluminium vogelringen');
        })->get();
        $inoxVogelringen = Ring::with('type')->whereHas('type', function ($query) {
            $query->where('name', 'Standaard RVS Ringen');
        })->get();
        // dd($inoxVogelringen);
        $cart = Cart::session(3);

        return view('order.index', compact('menuItems', 'cart', 'kleurVogelringen', 'inoxVogelringen'));
    }

    public function store(Request $request)
{
    $vogelring = Ring::findOrFail($request->vogelring);

    $quantity = $request->aantal[0];

    if ($quantity > 0) {
        // Check if the item already exists in the cart
        $existingItem = Cart::session(3)->get($vogelring->id);

        if ($existingItem) {
            // If the item exists, update the quantity by adding the new quantity to the existing quantity
            $newQuantity = $existingItem->quantity + $quantity;
            Cart::session(3)->update($existingItem->id, [
                'quantity' => [
                    'relative' => false,
                    'value' => $newQuantity,
                ],
            ]);
        } else {
            // If the item doesn't exist, add it to the cart
            Cart::session(3)->add([
                'id' => $vogelring->id,
                'name' => $vogelring->name,
                'diameter' => $vogelring->diameter,
                'price' => $vogelring->price,
                'type_id' => $vogelring->type_id,
                'description' => $vogelring->description,
                'quantity' => $quantity,
                'associatedModel' => $vogelring,
            ]);
        }
    }

    return redirect()->back();
}

    public function remove($id)
    {
        Cart::session(3)->remove($id);

        return redirect()->back();
    }
    public function update(Request $request)
    {
        $itemId = $request->input('item_id');
        $aantal = (int)$request->aantal[0];
        // dd($quantity);
        if ($aantal > 0) {
            Cart::update($itemId, [
                'aantal' => $aantal,
            ]);
        } else {
            Cart::remove($itemId);
        }
    
        return redirect()->back();
    }

    

}
