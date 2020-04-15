<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class CabletvLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:cabletv');
    }
    public function showLoginForm(){
        return view('auth.cabletv-login');
    }

    public function login(Request $request){
        //validate the form data
        $this->validate($request,[
            'box_no'    => 'required|min:6|max:14',
            'password' => 'required|min:10|max:10'
        ]);

        //Attempt to log the user in

        if(Auth::guard('cabletv')->attempt(['box_no'=> $request->box_no, 'password'=> $request->password],$request->remember)){
            return redirect()->intended(route('cabletv.dashboard'));
        }

        //if unsuccessfull, then redirect back to the login page

        return redirect()->back()->withInput($request->only('box_no','remember'));
    }
}
