<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    protected $table = 'religion';
    protected $primaryKey = 'religion_id';
    public $timestamps = false;

    public function profile() {
        return $this->hasMany('App\Profile', 'religion_id');
    }
}
