<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfSkills extends Model
{
    //
    protected $connection='gts';
    protected $fillable=['skill','a_id'];
}
