<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

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
        if(Auth::check() && Auth::user()->role == 'ADMIN'){ //check if employee has a role of ADMIN. //register middleware @ app/http/kernel
            return $next($request);
        }
        else{
            return abort(403);
        }
    }
}
