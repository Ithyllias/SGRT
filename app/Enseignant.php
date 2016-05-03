<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    protected $table = 'enseignant_ens';
    protected $primaryKey = 'ens_id';
    public $timestamps = false;
    //

    /**
     * @param $alias String Alias to fetch the ID from
     * @return mixed The actual id in the table
     */
    public static function getIdFromAlias($alias){
        return Enseignant::where('ens_alias', '=', $alias)->firstOrFail()->ens_id;
    }

    /**
     * @param $login String Login to fetch the ID from
     * @return mixed The actual id in the table
     */
    public static function getIdFromLogin($login){
        return Enseignant::where('ens_login', '=', $login)->firstOrFail()->ens_id;
    }

    /**
     * @param $login String Login to fetch the ID from
     * @return mixed The actual id in the table
     */
    public static function getLoginFromId($id){
        return Enseignant::where('ens_id', '=', $id)->firstOrFail()->ens_login;
    }

    public static function addOrUpdate($id, $data){
    }
}
