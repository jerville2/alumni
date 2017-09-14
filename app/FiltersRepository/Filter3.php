<?php
/**
 * Created by PhpStorm.
 * User: ITC
 * Date: 8/31/2017
 * Time: 2:09 PM
 */

namespace App\FiltersRepository;


class Filter3 implements Filters
{
    private $counter;
    function __construct()
    {
        $this->counter=new Counter();
    }

    public function filter($ans, $degs, $lim = null, $title)
    {
        $rep=array();
        $ret=array();
        $ex_array=array();
        array_push($ex_array,array($title));
        array_push($ret,$this->counter->cTotal($ans,$degs));

        $ex_r=array();
        array_push($ex_r,'Choices');
        foreach ($degs as $d){
            if($d->degs)
                array_push($ex_r,$d->degs->degree);
        }

        array_push($ex_r,'total');
        array_push($ex_array,$ex_r);


        foreach ($ans->unique('ans') as $r){
            if(!array_key_exists($r->ans,$rep)){
                $total=0;
                $t=array();
                array_push($t,$r->ans);
                $te=array();
                foreach ($degs as $d){

                    $c=$ans->where('ans',$r->ans)->where('degree_code',$d->degree)->count();


                    if($c>0){
                        $te['deg'.$d->degree.'_count']=$c;
                        $total+=$c;
                    }else{
                        $te['deg'.$d->degree.'_count']=0;
                        $total+=0;
                    }


                }

                $te['total_count']=$total;
                array_push($t,$te);
                array_push($ex_array,array($r->ans)+$te);

                $rep[$r->ans]=$t;
            }

        }//end of foreach
        array_push($ret,$rep);

        array_push($ret,$ex_array);
        return $ret;
    }
}