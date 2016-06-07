<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TacheReelle extends Model
{
    protected $table = 'tache_reelle_trl';
    protected $primaryKey = 'trl_id';
    public $timestamps = false;
    protected $fillable = array('trl_cdn_id', 'trl_ens_id');

    public function cours_donne()
    {
        return $this->belongsTo('App\CoursDonne', 'trl_cdn_id', 'cdn_id');
    }

    public function enseignant()
    {
        return $this->belongsTo('App\Enseignant', 'trl_ens_id', 'ens_id');
    }

    public static function addSingle($trl_cdn_id, $trl_ens_id){
        try{
            TacheReelle::create([
                'trl_cdn_id' => $trl_cdn_id,
                'trl_ens_id' => $trl_ens_id,
            ]);
            return true;
        } catch(\Exception $e) {
            var_dump($e->getMessage());
            return false;
        }
    }
}
