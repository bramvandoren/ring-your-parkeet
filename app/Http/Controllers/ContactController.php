<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;


class ContactController extends Controller
{
    public function index()
    {
        $menuItems = $this->menuItems;
        $menuItems[2]['active'] = "active";

        // $posts = Post::paginate(10); // SELECT * FROM posts
        $cart = Cart::session(3);

        return view('contact.index', compact('menuItems', 'cart'));
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

