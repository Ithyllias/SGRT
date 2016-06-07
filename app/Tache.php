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
            $tac->tac_complete = 1;
            $tac->save();
            return true;
        } catch(\Exception $e){
            return false;
        }
    }
}
