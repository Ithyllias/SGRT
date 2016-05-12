<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TacheReelle extends Model
{
    protected $table = 'tache_reelle_trl';
    protected $primaryKey = 'trl_id';
    public $timestamps = false;

    public function cours_donne()
    {
        return $this->belongsTo('App\CoursDonne', 'trl_cdn_id', 'cdn_id');
    }

    public function enseignant()
    {
        return $this->belongsTo('App\Enseignant', 'trl_ens_id', 'ens_id');
    }
}