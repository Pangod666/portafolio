<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($request)
    {
        
        $user = User::where('username', $request->username)->first();
        
        if($user->estado == "activo"){
            $request->authenticate();
        
            $request->session()->regenerate();
        
            return redirect()->intended(RouteServiceProvider::HOME);
        }
        else{
            echo "USUARIO INHABILITADO";
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
