<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    protected $table = 'degrees';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function majors(){
        return $this->hasMany('App\Major','degree_code');
    }

    public function college() {
        return $this->belongsTo('App\College','college_id');
    }

    public function alumni() {
        return $this->hasMany('App\Alumni', 'degree_code');
    }

    public function students() {
        return $this->hasMany('App\Student', 'degree');
    }
}
