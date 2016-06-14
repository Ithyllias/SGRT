<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    protected $table = 'tache_tac';
    protected $primaryKey = 'tac_id';
    public $timestamps = false;
    protected $fillable = array('tac_annee', 'tac_complete');

    /**
     *  Eloquent relationship method.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function choix()
    {
        return $this->hasMany('App\CoursDonne', 'cdn_tac_id', 'tac_id');
    }

    /**
     * Method that closes the last/current task
     * @return bool True if succeeded, false otherwise
     */
    public static function closeLastTask(){
        try {
            $lastTaskId = Tache::all()->max('tac_id');
            $lastTask = Tache::where('tac_id', $lastTaskId)->first();
            var_dump($lastTask);
            $lastTask->tac_complete = 1;
            $lastTask->save();
            return true;
        } catch(\Exception $e){
            var_dump($e->getMessage());
            return false;
        }
    }

    /**
     * Gets the Tache ID for a given year and creates it if it doesn't exist
     * @param $year Year string (xxxx-xxxx)
     * @return mixed Tache ID 
     */
    public static function getTacheIdForYear($year){
        $tacId = Tache::where('tac_annee', $year)->first();
        if($tacId == null){
            $tacId = Tache::create([
                'tac_annee' => $year
            ])->tac_id;
        } else {
            $tacId = $tacId->tac_id;
        }
        return $tacId;
    }

    /**
     * Closes a specific Tache given an ID
     * @param $tacId Tache ID
     * @return bool True if succeeded, false otherwise
     */
    public static function closeTache($tacId){
        try {
            $tac = Tache::where('tac_id', $tacId)->get();
            $tac->tac_complete = true;
            $tac->save();
            return true;
        } catch(\Exception $e){
            return false;
        }
    }

    /**
     * Checks whether or not the nearest task is currently active (opened)
     * @return bool True if it is, false otherwise
     */
    public static function isTaskClosed(){
        try {
            $maxTac = Tache::all()->max('tac_id');
            return Tache::where('tac_id', $maxTac)->first()->tac_complete == 1;
        } catch(\Exception $e){
            return false;
        }
    }
}
