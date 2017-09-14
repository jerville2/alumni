<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employment extends Model
{
    protected $table = 'employment';
    protected $primaryKey = 'emp_code';
    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\Employment', 'reg_id');
    }
}
