<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imgs extends Model
{
    protected $table = 'images';
    public $timestamps = false;

    public function album() {
        return $this->belongsTo('App\Album', 'album_id');
    }
}
