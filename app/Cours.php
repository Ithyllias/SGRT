<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    protected $table = 'cours_cou';
    protected $primaryKey = 'cou_no';
    public $timestamps = false;
    public $incrementing = false;
    /*
     * 
    */

    public function cours_donne(){
        return $this->hasMany('App\CoursDonne', 'cdn_cou_no', 'cou_no');
    }

    public function billes_depart()
    {
        return $this->hasMany('App\BillesDepart', 'bdp_cou_no', 'cou_no');
    }

    /**
     * @param $alias String Alias to fetch the ID from
     * @return mixed The actual id in the table
     */
    public static function getAllTasks(){
        $returnArray = [];
        $maxTache = CoursDonne::all()->max('cdn_tac_id');
        $coursDonnes = CoursDonne::where('cdn_tac_id', $maxTache)->get();

        foreach($coursDonnes as $coursDonne){
            array_push($returnArray, array('cou_titre' => $coursDonne->cours->cou_titre, 'cou_no' => $coursDonne->cours->cou_no, 'cdn_id' => $coursDonne->attributes['cdn_id']));
        }
        return array($returnArray);
    }

    /**
     * Returns all cours
     */
    public static function getAllCours(){
        return Cours::all();
    }

    /**
     * @param $list array {[cou_no, cou_compteur_max, cou_commentaire], []...}
     */
    public static function updateCours($list){
        $allCours = Collection::make();
        try{
            foreach($list as $element){
                $cours = Cours::where('cou_no', $element['cou_no']);
                $cours->cou_compteur_max = $element['cou_compteur_max'];
                $cours->cou_commentaire = $element['cou_commentaire'];
                $allCours->add($cours);
            }
        } catch(Exception $e) {
            return false;
        }

        $allCours->each(function ($item) {
            $item->save();
        });
        return true;
    }
}
