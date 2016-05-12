<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillesDepart extends Model
{
    protected $table = 'billes_depart_bdp';
    protected $primaryKey = 'bdp_id';
    public $timestamps = false;

    public function cours(){
        return $this->belongsTo('App\Cours', 'bdp_cou_no', 'cou_no');
    }

    public function enseignant(){
        return $this->belongsTo('App\Enseignant', 'bdp_ens_id', 'ens_id');
    }
}
