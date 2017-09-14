<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'accounts';
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password','email_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function alumni(){
        return $this->hasOne('App\Alumni', 'reg_id');
    }

    public function profile() {
        return $this->hasOne('App\Profile','reg_id');
    }

    public function employment() {
        return $this->hasMany('App\Employment', 'reg_id');
    }

    public function picture() {
        return $this->hasOne('App\Picture', 'reg_id');
    }

    public function student() {
        return $this->hasOne('App\Student', 'student_number');
    }

    public function addresses() {
        return $this->hasOne('App\Address', 'reg_id');
    }

    public function educations() {
        return $this->hasMany('App\Education', 'reg_id');
    }

    public function eligibility() {
        return $this->hasMany('App\Eligibility', 'reg_id');
    }

    public function organizations() {
        return $this->hasMany('App\Organization', 'reg_id');
    }

    public function publications() {
        return $this->hasMany('App\Publication', 'reg_id');
    }

    public function awards() {
        return $this->hasMany('App\Award', 'reg_id');
    }

    public function receipts() {
        return $this->hasOne('App\Receipt', 'reg_id');
    }

    public function posts() {
        return $this->hasMany('App\Post', 'reg_id');
    }

    public function likedPosts(){
        return $this->morphedByMany('App\Post', 'like')->whereDeletedAt(null);
    }
}
