<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'refcitymun';
    protected $primaryKey = 'citymunCode';
    public $incrementing = false;

    public function barangays() {
        return $this->hasMany('App\Brgy', 'citymunCode');
    }

    public function province() {
        return $this->belongsTo('App\Province','citymunCode');
    }

    public function profiles() {
        return $this->hasMany('App\Profile', 'citymunCode');
    }
}
