<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Documents;
use App\Models\ThemeSetting;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        if (Auth::check()) {
            if (Auth::user()->role == 'admin' && Auth::user()->status == '1') {
                //Set Then variable in session
                $themes = ThemeSetting::where('company_id',Auth::id())->get();
                if(count($themes) > 0){
                    foreach ($themes as $theme) {
                        // Store a value in the session
                        if(!empty($theme->key) && $theme->key == 'logo'){
                            session(['logo' => $theme->value]);
                        } else if (!empty($theme->key) && $theme->key == 'primary_color'){
                            session(['primary_color' => $theme->value]);
                        } else if (!empty($theme->key) && $theme->key == 'secondry_color'){
                            session(['secondry_color' => $theme->value]);
                        } else if (!empty($theme->key) && $theme->key == 'button_text_color'){
                            session(['button_text_color' => $theme->value]);
                        } else if (!empty($theme->key) && $theme->key == 'button_background_color'){
                            session(['button_background_color' => $theme->value]);
                        } else if (!empty($theme->key) && $theme->key == 'link_color'){
                            session(['link_color' => $theme->value]);
                        }
                    }
                }
                $checkDocuments = Documents::where('user_id', Auth::id())->get();
                if (count($checkDocuments) > 0) {
                    $flagStatus = true;
                    foreach ($checkDocuments as $row) {
                        if ($row->status == 'pending') {
                            $flagStatus = false;
                        } else {
                            $flagStatus = true;
                        }
                    }
                    if (!$flagStatus) {
                        Auth::logout();
                        Session::flush();
                        return redirect()->intended(RouteServiceProvider::PENDING);
                    } else {
                        return redirect()->intended(RouteServiceProvider::ADMIN);
                    }
                } else {
                    return redirect()->intended(RouteServiceProvider::DOCUMENT);
                }
             }
             else{
                return redirect('resetaccount_verify');
             }
            if (Auth::user()->role == 'superadmin') {
                return redirect()->intended(RouteServiceProvider::SUPERADMIN);
            }
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
