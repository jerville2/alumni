<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eligibility extends Model
{
    protected $table = 'cse';
    protected $primaryKey = 'cse_code';
    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\User', 'reg_id');
    }
}
