<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoursDonne extends Model
{
    protected $table = 'cours_donne_cdn';
    protected $primaryKey = 'cdn_id';
    public $timestamps = false;
    protected $fillable = array('cdn_nb_etudiants', 'cdn_tac_id', 'cdn_cou_no', 'cdn_ses_id');

    public function cours()
    {
        return $this->belongsTo('App\Cours', 'cdn_cou_no', 'cou_no');
    }

    public function session()
    {
        return $this->belongsTo('App\Session', 'cdn_ses_id', 'ses_id');
    }

    public function tache()
    {
        return $this->belongsTo('App\Tache', 'cdn_tac_id', 'tac_id');
    }

    public function choix()
    {
        return $this->hasMany('App\Choix', 'chx_cdn_id', 'cdn_id');
    }

    public function tache_reelle()
    {
        return $this->hasMany('App\TacheReelle', 'trl_cdn_id', 'cdn_id');
    }

    public static function addSingle($cdn_nb_etudiants, $cdn_tac_id, $cdn_cou_no, $cdn_ses_id){
        try{
            CoursDonne::create([
                'cdn_nb_etudiants' => $cdn_nb_etudiants,
                'cdn_tac_id' => $cdn_tac_id,
                'cdn_cou_no' => $cdn_cou_no,
                'cdn_ses_id' => $cdn_ses_id
            ]);
            return true;
        } catch(Exception $e) {
            return false;
        }
    }
}
