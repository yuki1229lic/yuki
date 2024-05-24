<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $auth;
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            if($request->user()->user_type == 3){
                return redirect()->guest('/user/dashboard');
            }elseif ($request->user()->user_type == 2){
                return redirect()->guest('/jober/dashboard');
            }
        }
        return $next($request);
    }
}
