<?php

namespace App\Http\Controllers;

use App\UserStatus;
use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;


class HomeController extends Controller
{
    public function index()
    {
        $menuItems = $this->menuItems;
        $menuItems[0]['active'] = "active";

        //user info (lidgeld)
        $user = auth()->user();
        // dd($user);
        $userStatus = UserStatus::where('user_id', $user->id)->first();

        $lidgeldBetaald = $userStatus ? $userStatus->isPaid() : false;
        // $posts = Post::paginate(10); // SELECT * FROM posts
        $cart = Cart::session(3);

        return view('home.index', compact('menuItems', 'cart', 'lidgeldBetaald'));
    }

    // public function show($slug)
    // {
    //   $menuItems = $this->menuItems;
    //   $menuItems[1]['active'] = true;


    //   // get post from slug
    //   $post = Post::where('slug', $slug)->first();
      

    //   return view('news.show', compact('post', 'menuItems'));
    // }
}
