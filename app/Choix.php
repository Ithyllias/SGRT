<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choix extends Model
{
    const NB_PRIO = 5;
    const NB_SESSION = 3;
    protected $table = 'choix_chx';
    protected $primaryKey = 'chx_id';
    public $timestamps = false;
    protected $fillable = array('chx_ens_id', 'chx_cdn_id', 'chx_priorite');

    /**
     *  Eloquent relationship method.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cours_donne(){
        return $this->belongsTo('App\CoursDonne', 'chx_cdn_id', 'cdn_id');
    }

    /**
     *  Eloquent relationship method.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function enseignant(){
        return $this->belongsTo('App\Enseignant', 'chx_ens_id', 'ens_id');
    }

    /**
     *  Returns all choices made by a given Enseignant
     * @param $ensId Enseignant ID
     * @return array Array containing all choices made
     */
    public static function getChoixForEnseignant($ensId){
        $returnChoix = array('1'=>[],'2'=>[],'3'=>[]);
        $maxTac = Tache::all()->max('tac_id');
        $choices = Choix::with(['cours_donne' => function ($query) use ($maxTac) {
            $query->where('cdn_tac_id', $maxTac);
        }])->where('chx_ens_id', $ensId)->orderBy('chx_priorite')->get();
        foreach($choices as $choix){
            if($choix->cours_donne != null) {
                array_push($returnChoix[$choix->cours_donne->cdn_ses_id], [
                    'chx_priorite' => $choix->chx_priorite,
                    'cou_no' => $choix->cours_donne->cours->cou_no,
                    'cou_titre' => $choix->cours_donne->cours->cou_titre
                ]);
            }
        }
        return $returnChoix;
    }

    /**
     * Method that adds an array of choices into the table
     * @param $choices Array of choices to add
     * @return bool True if succeeded, false otherwise
     */
    public static function addChoix($choices){
        try {
            foreach ($choices as $choix) {
                Choix::create([
                    'chx_ens_id' => $choix['chx_ens_id'],
                    'chx_cdn_id' => $choix['chx_cdn_id'],
                    'chx_priorite' => $choix['chx_priorite'],
                ])->save();
            }
        } catch(\Exception $e){
            return false;
        }
        return true;
    }

    /**
     * Checks the current status of a given Enseignant
     * @param $ensId Enseignant ID
     * @return array An array containing the status for each semester and the year of the current task
     */
    public static function choixStatus($ensId)
    {
        $count = array(1=>0,2=>0,3=>0);
        $maxTac = Tache::all()->max('tac_id');
        $tacAnnee = Tache::where('tac_id', $maxTac)->first()->tac_annee;

        $choices = Choix::with(['cours_donne' => function ($query) use ($maxTac) {
            $query->where('cdn_tac_id', $maxTac);
        }])->where('chx_ens_id', $ensId)->get();

        foreach($choices as $choix){
            if($choix->cours_donne != null ){
                $count[$choix->cours_donne->cdn_ses_id]++;
            }
        }

        return [
            'choixFait' => [
                'A' => $count[1] === self::NB_PRIO,
                'H' => $count[2] === self::NB_PRIO,
                'E' => $count[3] === self::NB_PRIO,
            ],
            'tac_annee' => $tacAnnee
        ];
    }

    /**
     * Clears the choices for a given Enseignant for a given Session
     * @param $ensId Enseignant ID
     * @param $sesId Session ID
     */
    public static function clearChoixForSession($ensId, $sesId){
        $choix = Choix::where('chx_ens_id', $ensId)->get();

        foreach($choix as $single){
            if($single->cours_donne->cdn_ses_id == $sesId){
                $single->delete();
            }
        }
    }

    /**
     * Gets the bid for a given Enseignant and class
     * @param $alias Enseignant Alias
     * @param $couno Cours ID
     * @return int 0 if no choice was made for the class, choice otherwise.
     */
    public static function getBidForCoursForAlias($alias, $couno){
        $maxTac = Tache::all()->max('tac_id');
        $ensId = Enseignant::getIdFromAlias($alias);
        $cdnId = CoursDonne::where('cdn_cou_no', '=', $couno)->where('cdn_tac_id', '=', $maxTac)->first()->cdn_id;
        $bid = Choix::where('chx_ens_id', '=', $ensId)->where('chx_cdn_id', '=', $cdnId)->first();
        return $bid == null ? 0 : $bid->chx_priorite;
    }
}
