<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $table = 'publications';
    protected $primaryKey = 'pub_code';
    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\User', 'reg_id');
    }
}
