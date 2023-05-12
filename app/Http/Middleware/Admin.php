<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\User; 
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // if (!Auth::check()) {
        //     return redirect()->route('login');
        // }

        // if (Auth::user()->role == 'superadmin') {
          
        //     return redirect()->route('superadmin');
        // }

        // if (Auth::user()->role == 'admin') {
        //     return $next($request);
        // }

        if (!Auth::check()){
            return redirect('/login');     
        }

        $userRole = User::find(Auth::user()->id);
        // dd($userRole->role);
        if($userRole->role == 'admin'){
            return $next($request);
        } else {
            return abort(404);
        }   
    }
}
