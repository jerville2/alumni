<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected $table = 'downloads';
    protected $primaryKey = 'dl_code';
    public $timestamps = false;
}
