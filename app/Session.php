<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = 'session_ses';
    protected $primaryKey = 'ses_id';
    public $timestamps = false;

    /**
     * Gets the session ID for a given name
     * @param $alias Session name
     * @return int -1 if the alias didn't have a corresponding Session, id otherwise
     */
    public static function getSessionIdFromAlias($alias){
        $sesId = Session::where('ses_initiale', $alias)->first();
        return $sesId == null ? -1 : $sesId->ses_id;
    }

    /**
     * Gets the Session name for a given Session ID
     * @param $id Session ID
     * @return mixed null if not found, name otherwise
     */
    public static function getSessionNameFromId($id){
        return Session::where('ses_id', $id)->first();
    }

    /**
     * Method that returns an array filled with the table info
     * @return array Array associating IDs and Names
     */
    public static function getSessions(){
        $returnValues = array();
        foreach(Session::all('ses_id', 'ses_nom') as $session){
            $returnValues[$session->ses_id] = $session->ses_nom;
        }
        return $returnValues;
    }
}
