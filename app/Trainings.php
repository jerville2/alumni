<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trainings extends Model
{
    //
    protected $connection='gts';
    protected $fillable=['a_id','training_id','title','duration','training_agency'];
    public function training(){
        return $this->hasOne('App\RefTraining','ID','training_id');
    }
}
