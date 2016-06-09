<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoursDonne extends Model
{
    protected $table = 'cours_donne_cdn';
    protected $primaryKey = 'cdn_id';
    public $timestamps = false;
    protected $fillable = array('cdn_nb_etudiants', 'cdn_tac_id', 'cdn_cou_no', 'cdn_ses_id');

    /**
     *  Eloquent relationship method.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cours()
    {
        return $this->belongsTo('App\Cours', 'cdn_cou_no', 'cou_no');
    }

    /**
     *  Eloquent relationship method.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function session()
    {
        return $this->belongsTo('App\Session', 'cdn_ses_id', 'ses_id');
    }

    /**
     *  Eloquent relationship method.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tache()
    {
        return $this->belongsTo('App\Tache', 'cdn_tac_id', 'tac_id');
    }

    /**
     *  Eloquent relationship method.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function choix()
    {
        return $this->hasMany('App\Choix', 'chx_cdn_id', 'cdn_id');
    }

    /**
     *  Eloquent relationship method.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tache_reelle()
    {
        return $this->hasMany('App\TacheReelle', 'trl_cdn_id', 'cdn_id');
    }

    /**
     *  Adds a single entry into the table given the parameters
     * @param $cdn_nb_etudiants Amount of students
     * @param $cdn_tac_id Tache ID
     * @param $cdn_cou_no Cours ID
     * @param $cdn_ses_id Session ID
     * @return bool True if succeeded, false otherwise
     */
    public static function addSingle($cdn_nb_etudiants, $cdn_tac_id, $cdn_cou_no, $cdn_ses_id){
        try{
            CoursDonne::create([
                'cdn_nb_etudiants' => $cdn_nb_etudiants,
                'cdn_tac_id' => $cdn_tac_id,
                'cdn_cou_no' => $cdn_cou_no,
                'cdn_ses_id' => $cdn_ses_id
            ]);
            return true;
        } catch(\Exception $e) {
            return false;
        }
    }

    /**
     *  Gets the CDN id for a set of parameters
     * @param $taskId Task ID
     * @param $sessId Session ID
     * @param $cou_no Cours ID
     * @return int -1 if none, the id otherwise.
     */
    public static function getCDNId($taskId, $sessId, $cou_no){
        try{
            return CoursDonne::where('cdn_tac_id', $taskId)->where('cdn_ses_id', $sessId)->where('cdn_cou_no', $cou_no)->first()->cdn_id;
        } catch(\Exception $e){
            return -1;
        }
    }
}
