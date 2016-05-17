<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Enseignant extends Model
{
    protected $table = 'enseignant_ens';
    protected $primaryKey = 'ens_id';
    public $timestamps = false;

    public function billes_depart()
    {
        return $this->hasMany('App\BillesDepart', 'bdp_ens_id', 'ens_id');
    }

    public function choix()
    {
        return $this->hasMany('App\Choix', 'chx_ens_id', 'ens_id');
    }

    /**
     * @param $alias String Alias to fetch the ID from
     * @return mixed The actual id in the table
     */
    public static function getIdFromAlias($alias){
        try {
            $id = Enseignant::where('ens_login', '=', $alias)->firstOrFail()->ens_id;
        } catch (ModelNotFoundException $e){
            $id = null;
        }
        return $id;
    }

    /**
     * @param $login String Login to fetch the ID from
     * @return mixed The actual id in the table
     */
    public static function getIdFromLogin($login){
        try {
            $id = Enseignant::where('ens_login', '=', $login)->firstOrFail()->ens_id;
        } catch (ModelNotFoundException $e){
            $id = null;
        }
        return $id;
    }

    /**
     * @param $login String Login to fetch the ID from
     * @return mixed The actual id in the table
     */
    public static function getLoginFromId($id){
        try {
            $enseignant = Enseignant::where('ens_id', '=', $id)->firstOrFail()->ens_login;
        } catch (ModelNotFoundException $e){
            $enseignant = null;
        }
        return $enseignant;
    }

    /**
     * Returns all enseignants
     */
    public static function getAllEnseignant(){
        return Enseignant::all(array('ens_id', 'ens_alias', 'ens_inactif', 'ens_commentaire', 'ens_coordonateur'));
    }

    /**
     * @param $list array {[cou_no, cou_compteur_max, cou_commentaire], []...}
     */
    public static function updateAllEnseignant($list){
        $allEns = Collection::make();
        try{
            foreach($list as $element){
                $ens = Enseignant::where('ens_id', $element->ens_id);
                $ens->ens_alias = $element->ens_alias;
                $ens->ens_inactif = $element->ens_inactif;
                $ens->ens_commentaire = $element->ens_commentaire;
                $ens->ens_coordonateur = $element->ens_coordonateur;
                $allEns->add($ens);
            }
        } catch(Exception $e) {
            return false;
        }

        $allEns->each(function ($item) {
            $item->save();
        });
        return true;
    }
}
