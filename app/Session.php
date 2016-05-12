<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = 'session_ses';
    protected $primaryKey = 'ses_id';
    public $timestamps = false;
}
