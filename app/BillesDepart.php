<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillesDepart extends Model
{
    protected $table = 'billes_depart_bdp';
    protected $primaryKey = 'bdp_id';
    public $timestamps = false;
    protected $fillable = array('bdp_ens_id', 'bdp_cou_no', 'bdp_nb');

    public function cours(){
        return $this->belongsTo('App\Cours', 'bdp_cou_no', 'cou_no');
    }

    public function enseignant(){
        return $this->belongsTo('App\Enseignant', 'bdp_ens_id', 'ens_id');
    }

    public static function addSingle($ensId, $cou_no, $billes){
        try{
            BillesDepart::create([
                'bdp_ens_id' => $ensId,
                'bdp_cou_no' => $cou_no,
                'bdp_nb' => $billes,
            ]);
            return true;
        } catch(\Exception $e) {
            return false;
        }
    }
}
