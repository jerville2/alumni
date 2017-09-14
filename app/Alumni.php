<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $table = 'mmsu_alumni';
    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\User','reg_id');
    }

    public function college() {
        return $this->belongsTo('App\College','college_code');
    }

    public function  degree() {
        return $this->belongsTo('App\Degree', 'degree_code','id');
    }

    public function  degs() {
        return $this->belongsTo('App\Degree', 'degree');
    }


    public function major() {
        return $this->belongsTo('App\major', 'major_code');
    }
}
