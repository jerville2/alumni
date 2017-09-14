<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    protected $connection = 'mysql2';
    protected $table = 'gradinfo';

    public function college() {
        return $this->belongsTo('App\College','college_code');
    }

    public function  degree() {
        return $this->belongsTo('App\Degree', 'degree_code');
    }

    public function major() {
        return $this->belongsTo('App\major', 'major_code');
    }

    public function educationals() {
        return $this->hasMany('App\Educational', 'app_code');
    }
}
