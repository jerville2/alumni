<?php
/**
 * Created by PhpStorm.
 * User: ITC
 * Date: 8/31/2017
 * Time: 2:01 PM
 */

namespace App\FiltersRepository;


class Filter1 implements Filters
{
    private $counter;
    function __construct()
    {
        $this->counter=new Counter();
    }
    //class is used for type 1
    public function filter($ans,$degs,$lim=null,$title)
    {
        $ch=$ans;
        $ret=array();
        $rep=array();
        $ex_array=array();
        array_push($ex_array,array($title));

        array_push($ret,$this->counter->cTotal($ch,$degs));
        $ex_r=array();
        array_push($ex_r,'Choices');
        foreach ($degs as $d){
            //dd($d->degs->degree);
            if($d->degs)
                array_push($ex_r,$d->degs->degree);
        }
        array_push($ex_r,'total');
        array_push($ex_array,$ex_r);

        foreach ($ch as $c){
            if(!array_key_exists($c->id,$rep)){
                $total=0;
                $t=array();

                array_push($t,$c->text);
                $te=array();
                foreach ($degs as $d){
                    if($d->degs){

                        $cc=$ch->where('id',$c->id)->where('degree',$d->degree)->count();
                        if($cc>0){
                            $te['deg'.$d->degree.'_count']=$cc;
                            $total+=$cc;

                        }else{
                            $te['deg'.$d->degree.'_count']=0;
                            $total+=0;
                        }

                    }//end of if



                }
                $te['total_count']=$total;
                array_push($t,$te);

                array_push($ex_array,array($c->text)+$te);
                $rep[$c->id]=$t;
            }


        }//end of foreach
        array_push($ex_array,array('Totals')+$this->countTotal($ch,$degs));
        array_push($ret,$rep);

        array_push($ret,$ex_array);
        return $ret;
    }
}