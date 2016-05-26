<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Collection;

class Enseignant extends Model
{
    protected $table = 'enseignant_ens';
    protected $primaryKey = 'ens_id';
    public $timestamps = false;
    protected $fillable = array('ens_alias', 'ens_inactif', 'ens_commentaire', 'ens_coordonateur', 'ens_login');

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

    public static function getIsCoordoFromId($id){
        try {
            $ens = Enseignant::where('ens_id', '=', $id)->firstOrFail()->ens_coordonateur;
        } catch (ModelNotFoundException $e){
            $ens = false;
        }
        return $ens;
    }

    /**
     * @param $login String Login to fetch the ID from
     * @return mixed The actual id in the table
     */
    public static function getIdFromLogin($login){
        try {
            $id = Enseignant::where('ens_login', '=', $login)->where('ens_inactif', '=', 0)->firstOrFail()->ens_id;
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
        return Enseignant::all(array('ens_id', 'ens_login', 'ens_alias', 'ens_inactif', 'ens_commentaire', 'ens_coordonateur'));
    }

    /**
     * @param $list array {[cou_no, cou_compteur_max, cou_commentaire], []...}
     */
    public static function updateAllEnseignant($list){
        $allEns = Collection::make();
        try{
            foreach($list as $element){
                if($element['ens_id'] != null) {
                    $ens = Enseignant::where('ens_id', $element['ens_id'])->first();
                } else {
                    $ens = Enseignant::create([
                        'ens_login' => $element['ens_login'],
                        'ens_alias' => $element['ens_alias'],
                        'ens_inactif' => $element['ens_inactif'],
                        'ens_commentaire' => $element['ens_commentaire'],
                        'ens_coordonateur' => $element['ens_coordonateur']
                    ]);
                }
                $ens->ens_alias = $element['ens_alias'];
                $ens->ens_inactif = $element['ens_inactif'];
                $ens->ens_commentaire = $element['ens_commentaire'];
                $ens->ens_coordonateur = $element['ens_coordonateur'];
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

    public static function test(){
        return Enseignant::where('ens_id', 99)->first() == null;
    }
}
