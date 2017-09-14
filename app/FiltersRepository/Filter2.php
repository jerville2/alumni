<?php
/**
 * Created by PhpStorm.
 * User: ITC
 * Date: 8/31/2017
 * Time: 2:07 PM
 */

namespace App\FiltersRepository;


class Filter2 implements Filters
{
    private $counter;
    function __construct()
    {
        $this->counter=new Counter();
    }

    public function filter($ans, $degs, $lim = null, $title)
    {
        //this if for ratings
        $ch=$ans;
        $rep=array();
        $ret=array();
        $ex_array=array();
        array_push($ret,$this->counter->cTotal($ch,$degs));
        foreach ($ch->unique('id') as $c){

            if(!array_key_exists($c->id,$rep)){
                $temp=array();
                array_push($temp,$c->id);
                array_push($temp,$c->text);

                $te=array();
                $t=0;
                foreach ($degs as $d){

                    if($d->degs){
                        $ex_t=array();
                        if(!array_key_exists($d->degree,$ex_array)){

                            $ex_array[$d->degree]=array();
                            $ex_r= array();
                            array_push($ex_r,'Choices');
                            for ($f=1;$f<=$lim;$f++){
                                array_push($ex_r,''.$f);
                            }

                            array_push($ex_array[$d->degree],$ex_r);

                        }

                        array_push($ex_t,$c->text);

                        for ($i=1;$i<=$lim;$i++){

                            $co=$ch->where('id',$c->id)->where('ans_rate',$i)->where('degree',$d->degree)->count();

                            if($co>0){
                                $te['college_'.$d->degree.'_'.$c->id.'_'.$i.'_count']=$co;
                                $t+=$co;
                                array_push($ex_t,$co);

                            }else {
                                $te['college_'.$d->degree.'_'.$c->id.'_'.$i.'_count']=0;
                                $t+=0;
                                array_push($ex_t,0);
                            }
                            $te['_total_count']=$t;




                        }//end of for
                        array_push($ex_t,$t);
                        //insert it here
                        // dd($d->degree);
                        array_push($ex_array[$d->degree],$ex_t);
                        //end of insert
                    }//end of if
                }//end of for each degs
                array_push($temp,$te);
                $rep[$c->id]=$temp;
            }
        }//end of foreach
        array_push($ret,$rep);
        array_push($ret,$ex_array);
        return $ret;
    }
}