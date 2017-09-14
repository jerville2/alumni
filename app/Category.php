<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected  $connection='gts';
    protected $fillable=['title','published'];
    public function items(){
        return $this->hasMany('App\Item','cat_id','id');
    }
    public function itemsType($id){
        return $this->hasMany('App\Item','cat_id','id')->where(function ($query){
            $query->where('type',2);
            $query->orWhere('type',5);
        })->where('id','!=',$id);
    }
}
