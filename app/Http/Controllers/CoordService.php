<?php

namespace App\Http\Controllers;


use App;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;

class CoordService extends Controller
{
    function addProf(){
        DB::enableQueryLog();
        $ens = [
            'ens_login' => request()->input('ens_login'),
            'ens_alias' => request()->input('ens_alias'),
            'ens_inactif' => intval(request()->input('ens_inactif')),
            'ens_commentaire' => request()->input('ens_commentaire'),
            'ens_coordonateur' => intval(request()->input('ens_coordonateur'))
        ];

        
        $ensId = App\Enseignant::getId($ens['ens_alias']);

        if($ensId > 0){
            $result = DB::table('enseignant_ens')
                ->where('ens_id', '=', $ensId[0]->ens_id)
                ->update($ens);
        } else {
            $result = DB::table('enseignant_ens')
                ->insert($ens);
        }
        DB::disableQueryLog();
        return response()->json(DB::getQueryLog());
    }

    //
    function test(){
        return response()->json(App\Enseignant::getId('ml'));
    }
}
