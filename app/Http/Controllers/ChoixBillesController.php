<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

use App\Http\Requests;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ChoixBillesController extends Controller
{
    public function getBilles(Request $request){
        $array = array();
        $bct = App\BillesCompteur::getBillesCompteur();

        foreach($bct as $bc){
            if(!array_key_exists($bc->bct_alias, $array)){
                $array[$bc->bct_alias] = [
                    'cours' => array(),
                ];
            }

            $array[$bc->bct_ens_alias]['cours'][$bc->bct_cou_no] = [
                'cours' => $bc->bct_cou_titre,
                'billes' => $bc->bct_billes,
                'compteur' => $bc->bct_compteurs
            ];
            
            if(App\Tache::isTaskClosed()){
                $array[$bc->bct_ens_alias]['cours'][$bc->bct_cou_no]['bid'] = App\Choix::getBidForCoursForAlias($bc->bct_ens_alias, $bc->bct_cou_no);
            }
        }

        return response()->json($array)->header('Access-Control-Allow-Origin', '*');
    }

    function submit(Request $request)
    {
        $values = $request->input();
        $ensId = $request->input('ensId');
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

        if(!isset($choices) || sizeof($choices) != 5 || strlen($choices['1']) == 0 || strlen($choices['2']) == 0 || strlen($choices['3']) == 0 || strlen($choices['4']) == 0 || strlen($choices['5']) == 0)
        {
            return redirect()->route('choix');
        }

        foreach ($choices as $key => $value) {
            array_push($insertData, [
                'chx_ens_id' => $ensId,
                'chx_cdn_id' => $value,
                'chx_priorite' => $key,
            ]);
        }

        $response = App\Choix::addChoix($insertData);

        if ($response == true) {
            return redirect()->route('choix');
        } else {
            return "" . $response;
        }
    }

    public function getProfs(Request $request){
        return response()->json(App\Enseignant::getAllActiveEnseignantAliases())->header('Access-Control-Allow-Origin', '*');
    }

    public function getActiveAliases(Request $request){
        return response()->json(App\Enseignant::getAllActiveEnseignantAliases())->header('Access-Control-Allow-Origin', '*');
    }
    function getTasks(Request $request){
        return response()->json(App\Cours::getAllTasks())->header('Access-Control-Allow-Origin', '*');
    }

    function getChoix(Request $request){
        return response()->json(App\Choix::getChoixForEnseignant(request()->input('user_id')))->header('Access-Control-Allow-Origin', '*');
    }

    function choixStatus(Request $request){
        return response()->json(App\Choix::choixStatus(request()->input('user_id')))->header('Access-Control-Allow-Origin', '*');
    }

    function test(Request $request){
        
        return "";
    }
}
