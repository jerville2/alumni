<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'reg_id',
        'post_id',
        'like_type',
        'owner',
    ];

    public function posts(){
        return $this->morphedByMany('App\Post', 'like');
    }

    public function getIsLikedAttribute(){
        $like = $this->likes()->whereRegId(Auth::user()->id)->first();
        return (!is_null($like)) ? true : false;
    }

}
