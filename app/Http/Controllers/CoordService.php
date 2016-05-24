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
        $values = request()->input('values');
        $users = [];


        foreach ($values as $key => $value){
            $user = [];
            if(!is_int($key))
            {
                if($value['alias'] == "" || strlen($value['alias']) > 5)
                {
                    $user['ens_id'] = "notValid";
                }
                else
                {
                    $user['ens_id'] = null;
                    $user['ens_login'] = $value['login'];
                }
            }
            else{
                $user['ens_id'] = $key;
                $user['ens_login'] = $value['login'];
            }
            if($user['ens_id'] != "notValid") {

                $user['ens_alias'] = $value['alias'];
                if (isset($value['actif']) && $value['actif'] == 'on') {
                    $user['ens_inactif'] = 0;
                } else {
                    $user['ens_inactif'] = 1;
                }
                if (isset($value['coord']) && $value['coord'] == 'on') {
                    $user['ens_coordonateur'] = 1;
                } else {
                    $user['ens_coordonateur'] = 0;
                }

                $user['ens_commentaire'] = $value['comm'];
                array_push($users, $user);
            }
        }
        return response()->json($users);
        //return response()->json(App\Enseignant::updateCours(request()->input('cours_list')));
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
