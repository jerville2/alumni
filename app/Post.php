<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';
    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\User', 'reg_id');
    }

    public function likes() {
        return $this->morphToMany('App\User', 'like','likes', 'post_id', 'reg_id')->whereDeletedAt(null);
    }
}
