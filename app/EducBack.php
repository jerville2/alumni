<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EducBack extends Model
{
    //
    protected $connection='gts';
    protected $table="educ_backs";
    protected $fillable=['a_id','college','degree','honor','ay'];
    public function h(){
        return $this->hasOne('App\Honors','ID','honor');
    }
    public function col(){
        return $this->hasOne('App\College','college_code','college');
    }
    public function deg(){
        return $this->hasOne('App\Degree','id','degree');
    }
    public function ay_d(){
        return $this->hasOne('App\Ay','ID','ay');
    }
}
