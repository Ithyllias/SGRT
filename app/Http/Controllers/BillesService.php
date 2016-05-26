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
            if(!array_key_exists($bc->bc_cou_titre, $array)){
                $array[$bc->bct_cou_no] = [
                    'cours' => $bc->bct_cou_titre,
                    'ens' => array()
                ];
            }

            array_push($array[$bc->bct_cou_no]['ens'], [
                'ens' => $bc->bct_ens_login,
                'billes' => $bc->bct_billes,
                'compteur' => $bc->bct_compteurs,
                'bid' => 0
            ]);
        }
        return response()->json($array)->header('Access-Control-Allow-Origin', '*');
    }

    function getProfs(){
        $profs = DB::table('enseignant_ens')
            ->select("ens_alias")
            ->where("ens_inactif", "=", "0")
            ->get();
        return response()->json($profs)->header('Access-Control-Allow-Origin', '*');
    }

    function getBillesCompteur(){

    }
    
    //
    function test(){
        
        
    }
    
    
}
