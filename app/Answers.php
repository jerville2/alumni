<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    //
    protected $connection='gts';
    protected $fillable = ['a_id', 'item_id', 'others','ans_rate','ans','choice_id',];
    public function person(){
        return $this->belongsTo('App\Alumni','a_id','reg_id');
    }
    public function choices(){
        return $this->belongsTo('App\Choices','choice_id','id');
    }
    public  function scopeFilter($query,$filters){
        $col=$filters['college'];
        $ay=$filters['ay'];
        $query->join('dbarotest.mmsu_alumni as al','al.reg_id','answers.a_id');
        $query->select(['answers.ans','degree_code','college_code']);
        $query->where('al.college_code',$col->college_code);
        $query->where('al.year_graduated',$ay);
        $query->orderBy('answers.ans');



    }
}
