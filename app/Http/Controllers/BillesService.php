<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

use App\Http\Requests;

class BillesService extends Controller
{
    function getBilles(){
        $array = array();
        $bct = App\BillesCompteur::getBillesCompteur();

        foreach($bct as $bc){
            if(!array_key_exists($bc->bct_alias, $array)){
                $array[$bc->bct_alias] = [
                    'cours' => array(),
                ];
            }

            $array[$bc->bct_ens_alias]['cours'][$bc->bct_cou_no] = [
                'cours' => $bc->bct_cou_titre,
                'billes' => $bc->bct_billes,
                'compteur' => $bc->bct_compteurs,
                //'bid' => App\Choix::getBidForCoursForAlias($bc->bct_ens_alias, $bc->bct_cou_no)
            ];
        }
        
        return response()->json($array)->header('Access-Control-Allow-Origin', '*');
    }

    function getProfs(){
        return response()->json(App\Enseignant::getAllActiveEnseignantAliases())->header('Access-Control-Allow-Origin', '*');
    }

    function getActiveAliases(){
        return response()->json(App\Enseignant::getAllActiveEnseignantAliases())->header('Access-Control-Allow-Origin', '*');;
    }
    
    //
    function test(){
        
        
    }
    
    
}
