<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'refprovince';
    protected $primaryKey = 'provCode';
    public $incrementing = false;

    public function cities(){
        return $this->hasMany('App\City','provCode');
    }

    public function profiles() {
        return $this->hasMany('App\Profiles', 'provCode');
    }
}
