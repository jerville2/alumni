<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ProfExam extends Model
{
    protected $connection='gts';
    protected $fillable=['a_id','date_exam','rating','exam'];
    public function setDateExamAttribute($value)
    {
        if($value!=null)
            $this->attributes['date_exam'] = Carbon::parse($value)->format('Y-m-d');
    }
    public function getDateExamAttribute()
    {
           return Carbon::parse($this->attributes['date_exam'])->format('F d, Y');
    }
    public function profD(){
        return $this->hasOne('App\Exams','ID','exam');
    }
}
