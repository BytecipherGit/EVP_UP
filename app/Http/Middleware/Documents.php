<?php

namespace App\Http\Middleware;
use Auth;
use Session;
use App\Models\Document;
use DB;
use Closure;


class Documents
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
      {
        // dd(Auth::id());
       $doc=DB::table('documents')->where('user_id',Auth::id())->first();

     if($doc){
        // dd($doc);
        if ($doc->status == '1') {
            return $next($request);
         }
          else {
                Auth::logout();
                Session::flush();	  
                return redirect()->route('login');
           }
        }
        else{
              // return $next($request);
                Auth::logout();
                Session::flush();	  
                return redirect()->route('login');
        }
          
       }
}
