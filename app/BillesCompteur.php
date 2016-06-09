<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillesCompteur extends Model
{
    protected $table = 'billes_compteur_bct';
    protected $primaryKey = 'bct_id';
    public $timestamps = false;
    public $incrementing = false;

    /**
     *  Method that returns the whole view for both marbles and times counter
     * @return \Illuminate\Database\Eloquent\Collection|static[] View for marbles and times counter
     */
    public static function getBillesCompteur(){
        return BillesCompteur::all();
    }
}
