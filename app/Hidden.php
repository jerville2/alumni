<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hidden extends Model
{
    //
    protected $connection='gts';
    protected $table='hidden';
    protected  $fillable=['h_id','hr_id','ch_id'];
    public function item(){
        return $this->hasOne('App\Item','id','h_id');
    }

    public function r_item(){
        return $this->hasOne('App\Item','id','hr_id');
    }
    public function r_ans(){
        return $this->hasOne('App\Choices','id','ch_id');
    }
}
