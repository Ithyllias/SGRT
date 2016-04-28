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
     * @param $alias Alias to fetch the ID from
     * @return mixed The actual id in the table
     */
    public static function getIdFromAlias($alias){
        return Enseignant::where('ens_alias', '=', $alias)->first()->ens_id;
    }

    /**
     * @param $login Login to fetch the ID from
     * @return mixed The actual id in the table
     */
    public static function getIdFromLogin($login){
        return Enseignant::where('ens_login', '=', $login)->first()->ens_id;
    }

    public static function addOrUpdate($id, $data){
        $ens = Enseignant::find($id);
    }
}
