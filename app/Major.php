<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    protected $table = 'majors';
    protected $primaryKey = 'major_code';
    public $timestamps = false;

    public function alumni() {
        return $this->hasMany('App\Alumni', 'major_code');
    }

    public function students() {
        return $this->hasMany('App\Student', 'major');
    }
}
