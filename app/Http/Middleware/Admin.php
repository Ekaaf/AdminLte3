<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Role;
use Closure;

class Admin
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

        if (Auth::check()){
            if (Auth::user()->role == 1){
                return $next($request);
            }
            else{
                return redirect()->intended('admin/login');
            }
        }
        else{
            return redirect()->intended('admin/login');
        }
        // return $next($request);
    }
}
