<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillesCompteur extends Model
{
    protected $table = 'billes_compteur_bct';
    protected $primaryKey = 'bct_id';
    public $timestamps = false;
    public $incrementing = false;

    public static function getBillesCompteur(){
        return BillesCompteur::all();
    }
}
