<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = 'session_ses';
    protected $primaryKey = 'ses_id';
    public $timestamps = false;

    public static function getSessionIdFromAlais($alias){
        $sesId = Session::where('ses_initiale', $alias)->first()->ses_id;
        return $sesId == null ? -1 : $sesId;
    }

    public static function getSessionNameFromId($id){
        return Session::where('ses_id', $id)->first();
    }

    public static function getSessions(){
        $returnValues = array();
        foreach(Session::all('ses_id', 'ses_nom') as $session){
            $returnValues[$session->ses_id] = $session->ses_nom;
        }
        return $returnValues;
    }
}
