<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\BestellingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\RingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LedenDashboardController;
use App\Http\Controllers\WebHookController;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\VoyagerAuthController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// HOME PAGE
Route::get('/', [HomeController::class, 'index'])->name('home.index');

// Contact page
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
// Auth routes voor inloggen en uitloggen
// Route voor het weergeven van het inlogformulier
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('auth.login');

// Route voor het verwerken van het inlogformulier
Route::post('/login', [LoginController::class, 'authenticated'])->name('login');
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/rich/thanks', [MoneyController::class, 'thanks'])->name('rich.thanks');

//Dashboard route
Route::middleware('auth')->group(function () {

    //PROFIEL
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route voor het weergeven van het leden dashboard
    Route::get('/leden-dashboard', [LedenDashboardController::class, 'index'])
        ->name('dashboard.index')
        ->middleware('isMember');


    // Route voor jaarlijks lidgeld
    Route::post('/leden-dashboard/betaling-lidgeld', [LedenDashboardController::class, 'betalingLidgeld'])->name('dashboard.betalingLidgeld');

    // Route voor het bestellen van ringen (formulier weergeven)
    Route::get('/leden-dashboard/ringen-bestellen', [RingController::class, 'index'])
        ->name('order.index');

    // Route voor het verwerken van het ringenbestelformulier (POST)
    Route::post('/leden-dashboard/ringen-bestellen', [RingController::class, 'store'])
        ->name('order.store');

    // Routes bestellingen geschiedenis
    Route::delete('/leden-dashboard/ringen-bestellen/{bestelling}', [LedenDashboardController::class, 'annuleerBestelling'])
    ->name('dashboard.annuleer-bestelling');
    Route::delete('/bestellingen/{bestelling}', [LedenDashboardController::class, 'verwijderBestelling'])->name('bestellingen.verwijderen');

    //Cart routes
    // Route voor het weergeven van de winkelwagen
    Route::get('/cart', [CartController::class, 'index'])->name('cart');

    // Route voor het toevoegen van een item aan de winkelwagen
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');

    // Route voor het bijwerken van een item in de winkelwagen
    Route::patch('/cart/update/{productId}', [CartController::class, 'updateCartItem'])->name('cart.update');

    // Route voor het verwijderen van een item uit de winkelwagen
    Route::get('/cart/remove/{id}', [RingController::class, 'remove'])->name('cart.remove');

    // Route voor het updaten van cart

    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');


});

// Route voor het afrekenen
Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('cart.checkout');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
Route::post('/webhooks/mollie', [WebHookController::class, 'handle'])->name('webhooks.mollie');


// Route voor admin
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::get('logout', [VoyagerAuthController::class, 'logout'])->name('voyager.logout');
});
