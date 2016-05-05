<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class HeaderManager
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
        if(!Session::get('jwt') === null) {
            $request->headers->set('Authorization', 'bearer ' . Session::get('jwt'));
        }
        return $next($request);
    }
}
