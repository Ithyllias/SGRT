<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    protected $table = 'cours_cou';
    protected $primaryKey = 'cou_no';
    public $timestamps = false;
    public $incrementing = false;
    /*
     * 
    */

    public function cours_donne(){
        return $this->hasMany('App\CoursDonne', 'cdn_cou_no', 'cou_no');
    }

    public function billes_depart()
    {
        return $this->hasMany('App\BillesDepart', 'bdp_cou_no', 'cou_no');
    }

    /**
     * @param $alias String Alias to fetch the ID from
     * @return mixed The actual id in the table
     */
    public static function getAllTasks(){
        $returnArray = [];
        $maxTache = CoursDonne::all()->max('cdn_tac_id');
        $coursDonnes = CoursDonne::where('cdn_tac_id', $maxTache)->get();

        foreach($coursDonnes as $coursDonne){
            array_push($returnArray, array('cou_titre' => $coursDonne->cours->cou_titre, 'cou_no' => $coursDonne->cours->cou_no, 'cdn_id' => $coursDonne->attributes['cdn_id']));
        }
        return array($returnArray);
    }
}
