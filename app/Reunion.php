<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reunion extends Model
{
    protected $table = 'reunions';
    protected $primaryKey = 'reun_code';
    public $timestamps = false;
}
