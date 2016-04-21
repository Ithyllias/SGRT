<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class ChoixService extends Controller
{
    //
    function getTasks(){
        $courses = DB::select('SELECT cou_no, cou_titre FROM cours_cou');

        return response()->json($courses)->header('Access-Control-Allow-Origin', '*');
    }
}
