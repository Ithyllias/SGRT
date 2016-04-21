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

    }
}
