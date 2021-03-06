<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Collection;
class Enseignant extends Model
{
    protected $table = 'enseignant_ens';
    protected $primaryKey = 'ens_id';
    public $timestamps = false;
    protected $fillable = array('ens_alias', 'ens_inactif', 'ens_commentaire', 'ens_coordonateur', 'ens_login');

    /**
     *  Eloquent relationship method.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function billes_depart()
    {
        return $this->hasMany('App\BillesDepart', 'bdp_ens_id', 'ens_id');
    }

    /**
     *  Eloquent relationship method.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function choix()
    {
        return $this->hasMany('App\Choix', 'chx_ens_id', 'ens_id');
    }
    /**
     * @param $alias String Alias to fetch the ID from
     * @return mixed The actual id in the table
     */
    public static function getIdFromAlias($alias){
        try {
            $id = Enseignant::where('ens_alias', '=', $alias)->firstOrFail()->ens_id;
        } catch (ModelNotFoundException $e){
            $id = null;
        }
        return $id;
    }

    /**
     *  Checks whether or not a specific Enseignant is a coordonateur
     * @param $id Enseignant ID
     * @return int True if it is, false otherwise.
     */
    public static function getIsCoordoFromId($id){
        try {
            $ens = Enseignant::where('ens_id', '=', $id)->firstOrFail()->ens_coordonateur;
        } catch (ModelNotFoundException $e){
            $ens = -1;
        }
        return $ens;
    }

    /**
     * @param $login String Login to fetch the ID from
     * @return mixed The actual id in the table
     */
    public static function getIdFromLogin($login){
        try {
            $id = Enseignant::where('ens_login', '=', $login)->where('ens_inactif', '=', 0)->firstOrFail()->ens_id;
        } catch (ModelNotFoundException $e){
            $id = null;
        }
        return $id;
    }

    /**
     * @param $login String Login to fetch the ID from
     * @return mixed The actual id in the table
     */
    public static function getLoginFromId($id){
        try {
            $enseignant = Enseignant::where('ens_id', '=', $id)->firstOrFail()->ens_login;
        } catch (ModelNotFoundException $e){
            $enseignant = null;
        }
        return $enseignant;
    }

    /**
     * Returns all enseignants
     */
    public static function getAllEnseignant(){
        return Enseignant::all(array('ens_id', 'ens_login', 'ens_alias', 'ens_inactif', 'ens_commentaire', 'ens_coordonateur'));
    }

    /**
     * Returns all enseignants
     */
    public static function getAllActiveEnseignantAliases(){
        return Enseignant::where('ens_inactif', '0')->select('ens_id', 'ens_alias')->get();
    }

    /**
     * @param $list array {[cou_no, cou_compteur_max, cou_commentaire], []...}
     */
    public static function updateAllEnseignant($list){
        $allEns = Collection::make();
        $uniqueLogin = array();
        $uniqueAlias = array();
        $returnNonUniques = array();
        try{
            foreach($list as $element){
                if (!in_array($element['ens_alias'], $uniqueAlias) && !in_array($element['ens_login'], $uniqueLogin)) {
                    if ($element['ens_id'] != null) {
                        $ens = Enseignant::where('ens_id', $element['ens_id'])->first();
                    } else {
                        $ens = Enseignant::create([
                            'ens_login' => $element['ens_login'],
                            'ens_alias' => $element['ens_alias'],
                            'ens_inactif' => $element['ens_inactif'],
                            'ens_commentaire' => $element['ens_commentaire'],
                            'ens_coordonateur' => $element['ens_coordonateur']
                        ]);
                    }
                } else {
                    array_push($returnNonUniques, $element['ens_login']);
                }
                array_push($uniqueLogin, $element['ens_login']);
                array_push($uniqueAlias, $element['ens_login']);
                $ens->ens_alias = $element['ens_alias'];
                $ens->ens_inactif = $element['ens_inactif'];
                $ens->ens_commentaire = $element['ens_commentaire'] == null ? '' : $element['ens_commentaire'];
                $ens->ens_coordonateur = $element['ens_coordonateur'];
                $allEns->add($ens);
            }
        } catch(Exception $e) {
            return false;
        }
        $allEns->each(function ($item) {
            $item->save();
        });
        return $returnNonUniques;
    }

    /**
     * Returns all Enseignants that have not completed all of their course selection.
     * @return array Array containing each Enseignant that hasn't done the course choice and which
     *               semester hasn't been completed.
     */
    public static function getMissingChoix(){
        $sessions = Session::getSessions();
        $returnValues = array();
        $maxTac = Tache::all()->max('tac_id');
        $choices = Enseignant::where('ens_inactif', 0)->with(['choix' => function ($query) use ($maxTac){
             $query->with(['cours_donne' => function($query) use ($maxTac){
                     $query->where('cdn_tac_id', $maxTac);
                 }]);
         }])->get();

        $tempChoix = array();

        foreach($choices as $ens) {
            $tempCount = 0;
            foreach($ens->choix as $single){
                if($single->cours_donne != null) {
                    $tempCount++;
                }
            }

            if ($tempCount < Choix::NB_PRIO*Choix::NB_SESSION){
                for ($i = 1; $i <= Choix::NB_SESSION; $i++) {
                    $tempChoix[$sessions[$i]] = false;
                }

                foreach ($ens->choix as $single) {
                    if($single->cours_donne != null) {
                        $tempChoix[$sessions[$single->cours_donne->cdn_ses_id]] = true;
                    }
                }

                array_push($returnValues, [
                    'ens_alias' => $ens->ens_alias,
                    'session' => $tempChoix,
                ]);
            }
        }
        return $returnValues;
    }

    public static function test(){
        return Enseignant::where('ens_id', 99)->first() == null;
    }
}