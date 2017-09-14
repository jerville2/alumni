<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choices extends Model
{
    //
    protected $connection='gts';
    protected $fillable=['op_val','text','item_id','old_id'];
    public function answers(){
        return $this->hasMany('App\Answers','choice_id','id');
    }
    public function scopeFilterType4($query,$filters){
        $col=$filters['college'];
        $sql=$filters['sql'];

        $query->join('answers','answers.choice_id','choices.id');
        $query->join('dbarotest.mmsu_alumni as c','c.reg_id','answers.a_id');
        $query->where('c.college_code',$col->college_code);
        $query->where('c.year_graduated',$filters['ay']);
        $query->select($sql);

        $query->orderBy('choices.id');

    }
    public function scopeFilter($query,$filters){
        $sql=$filters['sql'];
        $col=$filters['college'];
        $query->select($sql);
        $query->orderBy('choices.id');
        $query->join('answers','answers.choice_id','choices.id');
        $query->join('dbarotest.mmsu_alumni as c','c.reg_id','answers.a_id');
        $query->where('c.college_code',$col->college_code);
        $query->where('c.year_graduated',$filters['ay']);

    }
    public function item(){
        return $this->hasOne('App\Item','id','item_id');
    }
}
