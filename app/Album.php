<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'albums';
    public $timestamps = false;

    public function images() {
        return $this->hasMany('App\Imgs', 'album_id');
    }
}
