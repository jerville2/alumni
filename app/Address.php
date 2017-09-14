<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public $timestamps = false;
    protected $table = 'addresses';

    public function user() {
        return $this->belongsTo('App\User', 'reg_id');
    }
}
