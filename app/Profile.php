<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'pi';
    protected $primaryKey = 'pi_code';
    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\User', 'reg_id');
    }

    public function province() {
        return $this->belongsTo('App\Province', 'provCode');
    }

    public function  city() {
        return $this->belongsTo('App\City', 'citymunCode');
    }

    public function brgy() {
        return $this->belongsTo('App\Brgy', 'brgyCode');
    }

    public function civilStatus() {
        return $this->belongsTo('App\CivilStatus', 'civil_status_id');
    }

    public function citizen() {
        return $this->belongsTo('App\Citizen', 'citizenship_id');
    }
    public function religion() {
        return $this->belongsTo('App\Religion', 'religion_id');
    }
}
