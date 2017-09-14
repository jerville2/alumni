<?php
/**
 * Created by PhpStorm.
 * User: ITC
 * Date: 8/31/2017
 * Time: 2:20 PM
 */

namespace App\FiltersRepository;


class Counter
{
    private function countTotal($ch,$degs){
        $ret=array();
        foreach ($degs as $d){
            $ret['t_'.$d->degree.'_count']=$ch->unique('a_id')->where('degree',$d->degree)->count();
        }//end of for each
        return $ret;
    }//end of function
    public  function cTotal($ch,$degs){
        return $this->countTotal($ch,$degs);
    }
}