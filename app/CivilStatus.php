<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CivilStatus extends Model
{
    protected $table = 'civil_status';
    protected $primaryKey = 'civil_status_id';
    public $timestamps = false;
    public $incrementing = false;

    public function users() {
        return $this->hasMany('App\Profile', 'civil_status_id');
    }
}
