<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = 'session_ses';
    protected $primaryKey = 'ses_id';
    public $timestamps = false;

    public static function getSessionIdFromIni($ini){
        $sesId = Session::where('ses_initiale', $ini)->first()->ses_id;
        return $sesId == null ? -1 : $sesId;
    }
}
