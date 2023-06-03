<?php
namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Middleware\IsAdmin;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Node\Block\Document;
use TCG\Voyager\Http\Controllers\VoyagerAuthController;


class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $menuItems = $this->menuItems;
        return view('auth.login', compact('menuItems'));
    }

    public function authenticated(Request $request)
{
    $credentials = $request->only('firstname', 'password');
    $remember = $request->filled('remember');

    if (auth()->attempt($credentials, $remember)) {
        // Inloggen is gelukt, voer hier je gewenste acties uit
        return redirect('/leden-dashboard');
    } else {
        // Inloggen is mislukt, voer hier eventuele foutafhandeling uit
        return redirect()->back()->withErrors([
            'login' => 'Ongeldige inloggegevens',
        ]);
    }
}

}
