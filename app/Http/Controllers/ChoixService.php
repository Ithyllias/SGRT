<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class ChoixService extends Controller
{
    //
    function getTasks(){
        $courses = DB::table('cours_cou')->select('cou_no')->addSelect('cou_titre')->get();

        return response()->json($courses)->header('Access-Control-Allow-Origin', '*');
    }

    function submit($ensId, $a, $b, $c, $d, $e){
        DB::table('choix_chx')->insert([
            [
                'chx_priorite' => 1,
                'chx_cdn_id' => $a,
                'chx_ens_id' => $ensId
            ],
            [
                'chx_priorite' => 2,
                'chx_cdn_id' => $b,
                'chx_ens_id' => $ensId
            ],
            [
                'chx_priorite' => 3,
                'chx_cdn_id' => $c,
                'chx_ens_id' => $ensId
            ],
            [
                'chx_priorite' => 4,
                'chx_cdn_id' => $d,
                'chx_ens_id' => $ensId
            ],
            [
                'chx_priorite' => 5,
                'chx_cdn_id' => $e,
                'chx_ens_id' => $ensId
            ],
        ]);
    }
}
