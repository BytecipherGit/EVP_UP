<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $data['countries'] = Country::get(["name","id"]);
        return view('auth.register',$data);
    }


    public function getState(Request $request)
    {
        $data['states'] = State::where("country_id",$request->country_id)
                    ->get(["name","id"]);
        return response()->json($data);
    }
    public function getCity(Request $request)
    {
        $data['cities'] = City::where("state_id",$request->state_id)
                    ->get(["name","id"]);
        return response()->json($data);
    }
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'org_name' => ['required', 'string', 'max:255'],
            'org_web' => ['required', 'string', 'max:255'],
            'designation' => ['required', 'string', 'max:255'],
            'department' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'pin' => ['required', 'string']

        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'admin',
            'org_name' => $request->org_name,
            'org_web' =>$request->org_web,
            'designation' =>$request->designation,
            'department' =>$request->department,
            'address' =>$request->address,
            'country' =>$request->country,
            'state' =>$request->state,
            'city' =>$request->city,
            'pin' =>$request->pin,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // Auth::login($user);

        // return redirect(RouteServiceProvider::ADMIN);
     
        return redirect('login')->with('message','Registration Sucessfully');
     
    }
}
