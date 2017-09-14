<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brgy extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'refbrgy';
    protected $primaryKey = 'brgyCode';
    public $incrementing = false;

    public function profiles() {
        return $this->hasMany('App\Profile', 'brgyCode');
    }

}
