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

    public static function addOrUpdate($id, $data){
    }
}
