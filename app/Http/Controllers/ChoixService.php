<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class ChoixService extends Controller
{

    function getTasks(){
        return response()->json(App\Cours::getAllTasks())->header('Access-Control-Allow-Origin', '*');
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
        $values = request()->input();
        $ensId = request()->input('ensId');
        $choices = [];
        $insertData = [];

        foreach ($values as $key => $value){
            if($key != 'ensId') {
                switch ($value) {
                    case 1:
                        $choices['1'] = $key;
                        break;
                    case 2:
                        $choices['2'] = $key;
                        break;
                    case 3:
                        $choices['3'] = $key;
                        break;
                    case 4:
                        $choices['4'] = $key;
                        break;
                    case 5:
                        $choices['5'] = $key;
                        break;
                }
            }
        }

        if(strlen($choices['1']) == 0 || strlen($choices['2']) == 0 || strlen($choices['3']) == 0 || strlen($choices['4']) == 0 || strlen($choices['5']) == 0)
        {
            //TODO: validation choix en js
            return redirect()->route('choix');
        }

        foreach ($choices as $key => $value) {
            array_push($insertData, [
                'chx_ens_id' => $ensId,
                'chx_cdn_id' => $value,
                'chx_priorite' => $key,
            ]);
        }

        $response = DB::table('choix_chx')->insert($insertData);

        if ($response == true) {
            return redirect()->route('choix');
        } else {
            return "" . $response;
        }
    }

    function choixStatus(){
        $ensId = request()->input('ensId');
        $newestTache = DB::table('tache_tac')->max('tac_id');

        return response()->json(DB::table('choix_chx')
            ->select(DB::raw('count(*)=5 as choixFait'))
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
