<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TacheReelle extends Model
{
    protected $table = 'tache_reelle_trl';
    protected $primaryKey = 'trl_id';
    public $timestamps = false;
    protected $fillable = array('trl_cdn_id', 'trl_ens_id');

    /**
     *  Eloquent relationship method.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cours_donne()
    {
        return $this->belongsTo('App\CoursDonne', 'trl_cdn_id', 'cdn_id');
    }

    /**
     *  Eloquent relationship method.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function enseignant()
    {
        return $this->belongsTo('App\Enseignant', 'trl_ens_id', 'ens_id');
    }

    /**
     * Adds a single entry in the table given the parameters
     * @param $trl_cdn_id CoursDonne ID
     * @param $trl_ens_id Enseignant ID
     * @return bool True if succeeded, false otherwise
     */
    public static function addSingle($trl_cdn_id, $trl_ens_id){
        try{
            TacheReelle::create([
                'trl_cdn_id' => $trl_cdn_id,
                'trl_ens_id' => $trl_ens_id,
            ]);
            return true;
        } catch(\Exception $e) {
            return false;
        }
    }
}
