<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()){
            if(Auth::user()->role == 'admin'){
                return $next($request);
            } else {
                abort(403);
            }
        } else {
            return redirect()->route('login');
        }
    }
}
