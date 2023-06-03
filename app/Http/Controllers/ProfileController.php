<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Darryldecode\Cart\Facades\CartFacade as Cart;


class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $menuItems = $this->menuItems;
        $menuItems[0]['active'] = "active";
        $cart = Cart::session(3);
        return view('profile.index', compact('user' , 'menuItems', 'cart'));
    }

    public function edit()
    {
        $user = Auth::user();
        $menuItems = $this->menuItems;
        $menuItems[0]['active'] = "active";
        $cart = Cart::session(3);

        return view('profile.edit', compact('user', 'menuItems', 'cart'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        // Valideer de ingediende gegevens
        $this->validate($request, [
            'firstname' => 'required|string',
            'lastname' => 'nullable|string',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'password' => 'nullable|min:8|confirmed',
            // 'stamnr' => 'nullable|string',
            'address_street' => 'nullable|string',
            'address_nr' => 'nullable|string',
            'address_zipcode' => 'nullable|string',
            'address_city' => 'nullable|string',
            'birthdate' => 'nullable|date',
            'phone' => 'nullable|string',
        ]);
    
        // Werk de gebruikersgegevens bij
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        // $user->stamnr = $request->input('stamnr');
        $user->address_street = $request->input('address_street');
        $user->address_nr = $request->input('address_nr');
        $user->address_zipcode = $request->input('address_zipcode');
        $user->address_city = $request->input('address_city');
        $user->birthdate = $request->input('birthdate');
        $user->phone = $request->input('phone');

        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        // Werk hier andere velden bij op basis van je vereisten

        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profiel bijgewerkt!');
    }
}

