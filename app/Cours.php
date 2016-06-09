<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Cours extends Model
{
    protected $table = 'cours_cou';
    protected $primaryKey = 'cou_no';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = array('cou_no', 'cou_titre', 'cou_commentaire', 'cou_compteur_max');

    /**
     *  Eloquent relationship method.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cours_donne(){
        return $this->hasMany('App\CoursDonne', 'cdn_cou_no', 'cou_no');
    }

    /**
     *  Eloquent relationship method.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function billes_depart()
    {
        return $this->hasMany('App\BillesDepart', 'bdp_cou_no', 'cou_no');
    }

    /**
     * @param $alias String Alias to fetch the ID from
     * @return mixed The actual id in the table
     */
    public static function getAllTasks(){
        $returnArray = array(1=>array(),2=>array(),3=>array());
        $maxTache = CoursDonne::all()->max('cdn_tac_id');
        $coursDonnes = CoursDonne::where('cdn_tac_id', $maxTache)->get();

        foreach($coursDonnes as $coursDonne){
            array_push($returnArray[$coursDonne->cdn_ses_id], array('cou_titre' => $coursDonne->cours->cou_titre, 'cou_no' => $coursDonne->cours->cou_no, 'cdn_id' => $coursDonne->cdn_id));
        }

        return $returnArray;
    }

    /**
     * Returns all cours
     */
    public static function getAllCours(){
        return Cours::all();
    }

    /**
     * @param $list array {[cou_no, cou_compteur_max, cou_commentaire], []...}
     */
    public static function updateCours($list){
        $allCours = Collection::make();
        $uniqueCours = array();
        $returnNonUniques = array();
        try {
            foreach ($list as $element) {
                if (!in_array($element['cou_no'], $uniqueCours)) {
                    try {
                        $cours = Cours::where('cou_no', $element['cou_no'])->firstOrFail();
                        $cours->cou_commentaire = $element['cou_commentaire'];
                        $cours->cou_compteur_max = $element['cou_compteur_max'];
                    } catch (ModelNotFoundException $e) {
                        $cours = Cours::create([
                            'cou_no' => $element['cou_no'],
                            'cou_titre' => $element['cou_titre'],
                            'cou_commentaire' => $element['cou_commentaire'],
                            'cou_compteur_max' => $element['cou_compteur_max'],
                        ]);
                    }
                } else {
                    array_push($returnNonUniques, $element['cou_no']);
                }
                array_push($uniqueCours, $element['cou_no']);
                $allCours->add($cours);
            }
        }catch(Exception $e) {
            return false;
        }

        $allCours->each(function ($item) {
            $item->save();
        });
        return $returnNonUniques;
    }
}
