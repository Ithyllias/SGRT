<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    protected $table = 'tache_tac';
    protected $primaryKey = 'tac_id';
    public $timestamps = false;
    protected $fillable = array('tac_annee', 'tac_complete');

    public function choix()
    {
        return $this->hasMany('App\CoursDonne', 'cdn_tac_id', 'tac_id');
    }

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

    public static function isTaskClosed(){
        $maxTac = Tache::all()->max('tac_id');
        return Tache::where('tac_id', $maxTac)->first()->tac_complete == 1;
    }
}
