<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;

class VoyagerAuthController extends Controller
{
    use AuthenticatesUsers;

    // Override the logout method
    public function logout()
    {
        $this->guard()->logout();

        return redirect('/');
    }
    public function index()
    {
        $menuItems = $this->menuItems;
        $menuItems[0]['active'] = true;

        // $posts = Post::paginate(10); // SELECT * FROM posts
        return redirect('/admin/login')->with(compact('menuItems'));
    }
    
}
