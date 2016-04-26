<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class ChoixService extends Controller
{

    function getTasks(){
        $courses = DB::table('cours_cou')
            ->select('cou_no')
            ->addSelect('cou_titre')
            ->addSelect('cdn_id')
            ->join('cours_donne_cdn', 'cdn_cou_no', '=', 'cou_no')
            ->get();

        return response()->json($courses)->header('Access-Control-Allow-Origin', '*');
    }

    function getChoix(){
        $ensId = request()->input('ensId');
        $maxId = DB::table('tache_tac')->max('tac_id');

        $courses = DB::table('choix_chx')
            ->select('chx_priorite')
            ->addSelect('cou_no')
            ->addSelect('cou_titre')
            ->join('cours_donne_cdn', 'cdn_id', '=', 'chx_cdn_id')
            ->join('cours_cou', 'cou_no', '=', 'cdn_cou_no')
            ->where('chx_ens_id', '=', $ensId)
            ->where('cdn_tac_id', '=', $maxId)
            ->orderBy('chx_priorite')
            ->get();

        return response()->json($courses)->header('Access-Control-Allow-Origin', '*');
    }

    function submit()
    {
        $ensId = request()->input('ensId');
        $values = request()->input('values');

        $insertData = [];
        $i = 1;
        foreach ($values as $value) {
            array_push($insertData, [
                'chx_priorite' => $i,
                'chx_cdn_id' => $value,
                'chx_ens_id' => $ensId
            ]);
            $i++;
        }

        $response = DB::table('choix_chx')->insert($insertData);

        return "" . $response;
    }

    function choixStatus(){
        $ensId = request()->input('ensId');
        $newestTache = DB::table('tache_tac')->max('tac_id');

        return response()->json(DB::table('choix_chx')
            ->select(DB::raw('count(*)=5'))
            ->addSelect('tac_annee')
            ->join('cours_donne_cdn', 'cdn_id', '=', 'chx_cdn_id')
            ->join('tache_tac', 'tac_id', '=', 'cdn_tac_id')
            ->where('tac_id', '=', $newestTache)
            ->where('chx_ens_id', '=', $ensId)
            ->get())->header('Access-Control-Allow-Origin', '*');
    }

    function test(){

    }
}
