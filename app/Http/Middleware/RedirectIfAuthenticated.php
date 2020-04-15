<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Switch_;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch($guard){
            case 'admin':
                if(Auth::guard($guard)->check()){
                    return redirect()->route('admin.dashboard');
                }
            break;
            case 'agent':
                if(Auth::guard($guard)->check()){
                    return redirect()->route('agent.dashboard');
                }
            break;
            case 'broadband':
                if(Auth::guard($guard)->check()){
                    return redirect()->route('broadband.dashboard');
                }
            break;
            case 'cabletv':
                if(Auth::guard($guard)->check()){
                    return redirect()->route('cabletv.dashboard');
                }
            break;
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect(RouteServiceProvider::HOME);
                }
            break;
        }

        return $next($request);
    }
}
