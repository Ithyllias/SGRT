<?php

namespace App\Http\Controllers;


use App;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;

class CoordService extends Controller
{
    function addProf(){
        $ens = [
            'ens_login' => request()->input('ens_login'),
            'ens_alias' => request()->input('ens_alias'),
            'ens_inactif' => intval(request()->input('ens_inactif')),
            'ens_commentaire' => request()->input('ens_commentaire'),
            'ens_coordonateur' => intval(request()->input('ens_coordonateur'))
        ];

        return response()->json("LOL");
    }

    //
    function test(){
        return response()->json(App\Enseignant::getIdFromLogin('robert.aube'));
    }
}
