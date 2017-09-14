<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Citizen extends Model
{
    protected $table = 'citizenship';
    protected $primaryKey = 'citizenship_id';
    public $timestamps = false;

    public function profile() {
        return $this->hasmany('App\Profile', 'citizenship_id');
    }
}
