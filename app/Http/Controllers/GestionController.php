<?php

namespace App\Http\Controllers;


use App;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use Illuminate\Support\Facades\Request;

class GestionController extends Controller
{
    function addCours(Request $request){
        $values = $request->input('values');
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

        try {
            $update = App\Cours::updateCours($cours);
            if (count($update) > 0) {
                return redirect()->back()->with('error', trans('error.uniqueError') . implode(", ", $update));
            } else {
            }
        } catch(QueryException $e){
            return redirect()->back()->with('error', trans('error.dberror'));
        }

        return redirect()->back();
    }

    function closeTask(Request $request){
        if(App\Tache::closeLastTask()){
            return redirect()->back()->with('success', trans('gestion.closeSuccess'));
        } else {
            return redirect()->t();//back()->with('error', trans('error.closeError'));
        }
    }

    function getCours(Request $request){
        return response()->json(App\Cours::getAllCours());
    }

    function getEnseignant(Request $request){
        return response()->json(App\Enseignant::getAllEnseignant());
    }

    public function resetMarbles(Request $request){
        if(App\BillesDepart::truncateBillesDepart()){
            return redirect()->back()->with('success', trans('gestion.resetSuccess'));
        } else {
            return redirect()->back()->with('error', trans('error.resetError'));
        }
    }

    function updateEnseignants(Request $request){
        $values = $request->input('values');
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
            $update = App\Enseignant::updateAllEnseignant($users);
            if (count($update) > 0) {
                return redirect()->back()->with('error', trans('error.uniqueError') . implode(", ", $update));
            } else {
            }
        } catch(QueryException $e){
            return redirect()->back()->with('error', trans('error.dberror'));
        }

        return redirect()->back();
    }

    function test(){
        App\Enseignant::getMissingChoix();
        return response();
    }
}
