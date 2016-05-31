<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choix extends Model
{
    protected $table = 'choix_chx';
    protected $primaryKey = 'chx_id';
    public $timestamps = false;
    protected $fillable = array('chx_ens_id', 'chx_cdn_id', 'chx_priorite');

    public function cours_donne(){
        return $this->belongsTo('App\CoursDonne', 'chx_cdn_id', 'cdn_id');
    }

    public function enseignant(){
        return $this->belongsTo('App\Enseignant', 'chx_ens_id', 'ens_id');
    }

    public static function getChoixForEnseignant($ensId){
        $returnChoix = array();
        $maxTac = Tache::all()->max('tac_id');
        $choices = Choix::with(['cours_donne' => function ($query) use ($maxTac) {
            $query->where('cdn_tac_id', $maxTac);
        }])->where('chx_ens_id', $ensId)->orderBy('chx_priorite')->get();
        foreach($choices as $choix){
            array_push($returnChoix, [
                'chx_priorite' => $choix->chx_priorite,
                'cou_no' => $choix->cours_donne->cours->cou_no,
                'cou_titre' => $choix->cours_donne->cours->cou_titre
            ]);
        }
        return $returnChoix;
    }

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

    public static function choixStatus($ensId)
    {
        $maxTac = Tache::all()->max('tac_id');
        $tacAnnee = Tache::where('tac_id', $maxTac)->first()->tac_annee;

        $choices = Choix::with(['cours_donne' => function ($query) use ($maxTac) {
            $query->where('cdn_tac_id', $maxTac);
        }])->where('chx_ens_id', $ensId)->count();

        return [
            'choixFait' => $choices === 5,
            'tac_annee' => $tacAnnee
        ];
    }

    /*public static function getBidForCoursForAlias($alias, $couno){
        $maxTac = Tache::all()->max('tac_id');
        $ensId = Enseignant::getIdFromAlias($alias);
        $cdnId = CoursDonne::where('cdn_cou_no', '=', $couno)->where('cdn_tac_id', '=', $maxTac)->first()->cdn_id;
        return Choix::where('chx_ens_id', '=', $ensId)->where('chx_cdn_id', '=', $cdnId)->firstOrFail()->chx_priorite;
    }*/
}
