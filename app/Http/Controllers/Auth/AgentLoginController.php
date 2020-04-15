<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class AgentLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:agent');
    }
    public function showLoginForm(){
        return view('auth.agent-login');
    }

    public function login(Request $request){
        //validate the form data
        $this->validate($request,[
            'agent_id'    => 'required|min:6|max:14',
            'password' => 'required|min:10|max:10'
        ]);

        //Attempt to log the user in

        if(Auth::guard('agent')->attempt(['agent_id'=> $request->agent_id, 'password'=> $request->password],$request->remember)){
            return redirect()->intended(route('agent.dashboard'));
        }

        //if unsuccessfull, then redirect back to the login page

        return redirect()->back()->withInput($request->only('agent_id','remember'));
    }
}
