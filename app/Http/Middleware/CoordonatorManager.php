<?php

namespace App\Http\Middleware;

use App\Enseignant;
use App\Exceptions\NotAllowedException;
use Closure;
use Illuminate\Support\Facades\Session;

class CoordonatorManager
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
        try {
            $this->checkIsAllowed(Session::get('user_id'));
        } catch (NotAllowedException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        
        return $next($request);
    }

    private function checkIsAllowed($id){
        if(Enseignant::getIsCoordoFromId($id) == 0){
            throw new NotAllowedException(trans('error.accessError'));
        } else {
            return true;
        }
    }
}
