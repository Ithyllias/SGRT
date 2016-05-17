<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

class ChoixService extends Controller
{

    function getTasks(){
        return response()->json(App\Cours::getAllTasks())->header('Access-Control-Allow-Origin', '*');
    }

    function getChoix(){
        return response()->json(App\Choix::getChoixForEnseignant(request()->input('user_id')))->header('Access-Control-Allow-Origin', '*');
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

        if(!isset($choices) || sizeof($choices) != 5 || strlen($choices['1']) == 0 || strlen($choices['2']) == 0 || strlen($choices['3']) == 0 || strlen($choices['4']) == 0 || strlen($choices['5']) == 0)
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

        $response = App\Choix::addChoix($insertData);

        if ($response == true) {
            return redirect()->route('choix');
        } else {
            return "" . $response;
        }
    }

    function choixStatus(){
        return response()->json(App\Choix::choixStatus(request()->input('user_id')))->header('Access-Control-Allow-Origin', '*');
    }

    function test(){
        return response()->json(App\Enseignant::test());
    }
}
