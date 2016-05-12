<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    protected $table = 'tache_tac';
    protected $primaryKey = 'tac_id';
    public $timestamps = false;

    public function choix()
    {
        return $this->hasMany('App\CoursDonne', 'cdn_tac_id', 'tac_id');
    }
}
