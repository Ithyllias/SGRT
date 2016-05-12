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
}
