<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class ChoixService extends Controller
{
    //
    function getTasks(){
        $courses = DB::table('cours_cou')
            ->select('cou_no')
            ->addSelect('cou_titre')
            ->addSelect('cdn_id')
            ->join('cours_donne_cdn', 'cdn_cou_no', '=', 'cou_no')
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

    function test(){

    }
}
