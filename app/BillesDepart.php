<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillesDepart extends Model
{
    protected $table = 'billes_depart_bdp';
    protected $primaryKey = 'bdp_id';
    public $timestamps = false;
    protected $fillable = array('bdp_ens_id', 'bdp_cou_no', 'bdp_nb');

    /**
     *  Eloquent relationship method.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cours(){
        return $this->belongsTo('App\Cours', 'bdp_cou_no', 'cou_no');
    }

    /**
     *  Eloquent relationship method.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function enseignant(){
        return $this->belongsTo('App\Enseignant', 'bdp_ens_id', 'ens_id');
    }

    /**
     *  Adds a single entry into the database.
     * @param $ensId Enseignant ID
     * @param $cou_no Cours ID
     * @param $billes Amount of marbles
     * @return bool True if it succeeded, false otherwise.
     */
    public static function addSingle($ensId, $cou_no, $billes){
        try{
            BillesDepart::create([
                'bdp_ens_id' => $ensId,
                'bdp_cou_no' => $cou_no,
                'bdp_nb' => $billes,
            ]);
            return true;
        } catch(\Exception $e) {
            return false;
        }
    }

    /**
     * Empties the billesdepart table
     * @return bool True if it succeeded, false otherwise.
     */
    public static function truncateBillesDepart(){
        try{
            BillesDepart::truncate();
            return true;
        } catch(\Exception $e) {
            return false;
        }
    }

    /**
     * Checks whether or not the table has entries in it
     * @return bool True if it succeeded, false otherwise.
     */
    public static function checkEmpty(){
        try{
            BillesDepart::firstOrFail();
            return true;
        } catch(\Exception $e) {
            return false;
        }
    }
}
