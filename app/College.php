<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    protected $connection='mysql';
    protected $table = 'colleges';
    protected $primaryKey = 'college_code';
    public $timestamps =false;

    public function degrees(){
        return $this->hasMany('App\Degree','college_id');
    }

    public function alumni() {
        return $this->hasMany('App\Alumni','college_code');
    }

    public function students() {
        return $this->hasMany('App\Student', 'college');
    }
}
