<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class BillesService extends Controller
{
    function getBilles(){
        $billes = DB::select("CALL getBilles()");

        return response()->json($billes)->header('Access-Control-Allow-Origin', '*');
    }

    function getProfs(){
        $profs = DB::table('enseignant_ens')
            ->select("ens_alias")
            ->where("ens_inactif", "=", "0")
            ->get();
        return response()->json($profs)->header('Access-Control-Allow-Origin', '*');
    }
    
    //
    function test(){
        
        
    }
    
    
}
