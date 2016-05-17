<?php

namespace App\Http\Controllers;


use App;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;

class CoordService extends Controller
{
    function getEnseignant(){
        return response()->json(App\Enseignant::getAllEnseignant());
    }

    function updateEnseignants(){
        return response()->json(App\Enseignant::updateCours(request()->input('cours_list')));
    }

    function addCours(){
        return response()->json(App\Cours::updateCours(request()->input('cours_list')));
    }

    function getCours(){
        return response()->json(App\Cours::getAllCours());
    }
    //
    function test(){
        return response()->json(App\Enseignant::getIdFromLogin('robert.aube'));
    }
}
