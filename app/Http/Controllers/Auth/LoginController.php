<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function login(LoginRequest $request)
    {
        $user = User::where('username', $request->username)->first();
        if ($user) {
            if($user->estado == "activo"){
                
                $request->authenticate();
                $request->session()->regenerate();
                return redirect()->intended(route('dashboard'));
            }
            else{
                session()->flash('mensaje', "USUARIO INHABILITADO");
                return redirect(route('login'));
            }
        }else{
            session()->flash('mensaje', "USUARIO NO EXISTENTE");
            return redirect(route('login'));
        }
        
    }
}
