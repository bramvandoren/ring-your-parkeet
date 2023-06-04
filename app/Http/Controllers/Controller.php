<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    // data for menu
    public $menuItems = [];

    // constructor with data for menu
    public function __construct()
{
    $this->menuItems = [
        [
            'title' => 'Home',
            'url' => '/',
            'active' => false
        ],
        [
            'title' => 'LedenDashboard',
            'url' => '/leden-dashboard',
            'active' => false
        ],
        [
            'title' => 'Contact',
            'url' => '/contact',
            'active' => false
        ],
        
    ];

    // Check if user is logged in
    // if (Auth::check()) {
    //     $this->menuItems[2]['active'] = true; // Set 'active' to true for 'Ringen' menu item
    // } else {
    //     $this->menuItems = array_slice($this->menuItems, 0, 3); // Remove 'Ringen' menu item for public users
    // }
}



    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}