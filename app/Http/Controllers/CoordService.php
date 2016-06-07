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
                if($value['alias'] == "" || strlen($value['alias']) > 5 || $value['login'] == "" || strlen($value['login']) > 50 )
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
                if($value['alias'] != "" && strlen($value['alias']) <= 5) {
                    $user['ens_id'] = $key;
                }
                else{
                    $user['ens_id'] = "notValid";
                }
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
        try {
            if (App\Enseignant::updateAllEnseignant($users)) {
            } else {
            }
        } catch(QueryException $e){
            return redirect()->back()->with('error', trans('error.dberror'));
        }

        return redirect()->back();
    }

    function addCours(){
        $values = request()->input('values');
        $cours = [];

        foreach ($values as $key => $value){
            $cour = [];

            $cour['cou_no'] = $value['no'];
            $cour['cou_titre'] = $value['titre'];
            $cour['cou_commentaire'] = $value['comm'];
            $cour['cou_compteur_max'] = $value['compt_max'];

            $temp = str_split($cour['cou_no']);
            if($cour['cou_compteur_max'] > 0 && $cour['cou_no'] != "" && $cour['cou_titre'] != "" && sizeof($temp) == 10 && $temp[3] == "-" && $temp[7] == "-")
            {
                array_push($cours, $cour);
            }
        }

        if(App\Cours::updateCours($cours)){
        } else {
        }

        return redirect()->back();
        //return response()->json($cours);
    }

    function getCours(){
        return response()->json(App\Cours::getAllCours());
    }
    //
    function test(){
        return response()->json(App\BillesCompteur::getBillesCompteur());
    }
}
