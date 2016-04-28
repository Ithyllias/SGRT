<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    protected $table = 'enseignant_ens';
    protected $primaryKey = 'ens_id';
    public $timestamps = false;
    //

    public static function getId($alias){
        return Enseignant::where('ens_alias', '=', $alias)->first()->ens_id;
    }
}
