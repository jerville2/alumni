<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $connection='gts';
    protected $fillable=['desc','type','cat_id'];
    public function choices(){
        return $this->hasMany('App\Choices','item_id','id');

    }
    public function form(){
        return $this->belongsTo('App\Types','type','id');
    }

    //public function m_choice() {
      //  return $this->choices->pluck('text','id');
    //}
    public function addChoices($data){
        $this->choices()->create($data);
    }
    public function answer(){
        return $this->hasMany('App\Answers','item_id','id');
    }

    public function answers($a_id){
       return $this->hasMany('App\Answers','item_id','id')->where('a_id',$a_id);
    }
    public function answers_type34($a_id,$c_id){
        return $this->hasMany('App\Answers','item_id','id')->where('a_id',$a_id)
            ->where('choice_id',$c_id);
    }

    public function answers_others($a_id){
        return $this->hasMany('App\Answers','item_id','id')->where('a_id',$a_id)
            ->where('others','!=',null);
    }

    public function h(){
        return $this->hasMany('App\Hidden','h_id','id');
    }

    public function hr(){
        return $this->hasMany('App\Hidden','hr_id','id');
    }

    public function hr1($id,$h){
        return $this->hasMany('App\Hidden','hr_id','id')->where('h_id',$h)->where('ch_id',$id);
    }


}
