<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choix extends Model
{
    protected $table = 'choix_chx';
    protected $primaryKey = 'chx_id';
    public $timestamps = false;

    public function cours_donne(){
        return $this->belongsTo('App\CoursDonne', 'chx_cdn_id', 'cdn_id');
    }

    public function enseignant(){
        return $this->belongsTo('App\Enseignant', 'chx_ens_id', 'ens_id');
    }

    public static function getChoixForEnseignant($ensId){
        $returnChoix = array();
        $maxTac = Tache::all()->max('tac_id');
        $choices = Choix::where('chx_ens_id', $ensId)->orderBy('chx_priorite')->get();

        foreach($choices as $choix){
            if($choix->cours_donne->cdn_tac_id == $maxTac) {
                array_push($returnChoix, [
                    'chx_priorite' => $choix->chx_priorite,
                    'cou_no' => $choix->cours_donne->cours->cou_no,
                    'cou_titre' => $choix->cours_donne->cours->cou_titre
                ]);
            }
        }
        return $returnChoix;
    }
}
