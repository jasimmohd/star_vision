<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class BroadbandLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:broadband');
    }
    public function showLoginForm(){
        return view('auth.broadband-login');
    }

    public function login(Request $request){
        //validate the form data
        $this->validate($request,[
            'customer_id'    => 'required|min:6|max:14',
            'password' => 'required|min:10|max:10'
        ]);

        //Attempt to log the user in

        if(Auth::guard('broadband')->attempt(['customer_id'=> $request->customer_id, 'password'=> $request->password],$request->remember)){
            return redirect()->intended(route('broadband.dashboard'));
        }

        //if unsuccessfull, then redirect back to the login page

        return redirect()->back()->withInput($request->only('customer_id','remember'));
    }
}
