<?php

namespace App\Http\Middleware;

use App\Enseignant;
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
        if(Session::get('connected_user') !== null){
            $id = Enseignant::getIdFromLogin(Session::get('connected_user'));
            if($id === null){
                Session::forget('jwt');
                Session::forget('connected_user');
                Session::forget('user_id');
            }
        }

        if(Session::get('jwt') !== null) {
            $request->headers->set('Authorization', 'bearer ' . Session::get('jwt'));
        }
        return $next($request);
    }
}
