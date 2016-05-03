<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoursDonne extends Model
{
    protected $table = 'cours_donne_cdn';
    protected $primaryKey = 'cdn_id';
    public $timestamps = false;

    /**
    * Get the post that owns the comment.
    */
    public function cours()
    {
        return $this->belongsTo('App\Cours', 'cdn_cou_no', 'cou_no');
    }
}
