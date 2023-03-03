<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Documents;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Session;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    use AuthenticatesUsers;
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $document=Documents::where('user_id',Auth::id())->first();
        // print_r($document->status);die();
    if(Auth::user()->role == 'admin'){
        if($document){
        switch($document->status){
          
            case 'pending':  
                Auth::logout();
                Session::flush();  
                return redirect()->intended(RouteServiceProvider::PENDING);   
                break;
            case 'verified':
                return redirect()->intended(RouteServiceProvider::ADMIN);
                break;
                default:
                return redirect()->intended(RouteServiceProvider::DOCUMENT);
                }
            }
       else{
           return redirect()->intended(RouteServiceProvider::DOCUMENT);
         }
        }
        if(Auth::user()->role == 'superadmin'){
            return redirect()->intended(RouteServiceProvider::SUPERADMIN);
        }
        
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
