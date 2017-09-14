<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'education';
    protected $connection = 'mysql';
    protected $primaryKey = 'educ_code';
    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\User', 'reg_id');
    }
}
