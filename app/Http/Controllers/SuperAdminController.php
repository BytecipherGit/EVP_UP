<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class SuperAdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('superadmin/index');
    }

    public function logout(Request $request) {	  	  	
        Auth::logout();
        Session::flush();	  
        return redirect('/superlogin');
      }
}
