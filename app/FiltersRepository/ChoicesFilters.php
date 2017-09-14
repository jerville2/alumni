<?php
 namespace App\FiltersRepository;
 class ChoicesFilters{
     public function filterType4($ch,$degs,$lim,$title){
         $rep=array();
         $ret=array();
         $ex_array=array();
         array_push($ret,$this->countTotal($ch,$degs));
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
     }//end of functions;

     public function filter($ch,$degs,$title){
         $ret=array();
         $rep=array();
         $ex_array=array();
         array_push($ex_array,array($title));

         array_push($ret,$this->countTotal($ch,$degs));
         $ex_r=array();
         array_push($ex_r,'Choices');
         foreach ($degs as $d){
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