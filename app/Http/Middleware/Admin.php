<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\User; 
use Carbon\Carbon;
use App\Models\CompanySubscription; 
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
        // dd('hii');
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role == 'admin') {
            return $next($request);
        } else{
            return redirect()->route('superadmin.index');
        }
       

    }
}
