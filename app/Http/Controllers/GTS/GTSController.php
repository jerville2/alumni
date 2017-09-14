<?php

namespace App\Http\Controllers\GTS;

use App\Answers;
use App\Ay;
use App\Category;
use App\College;
use App\EducBack;
use App\Exams;
use App\Forms;
use App\Honors;
use App\Item;
use App\ProfExam;
use App\ProfSkills;
use App\RefTraining;
use App\Trainings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;


class GTSController extends Controller
{
    //

    public  function gts($id,$c){
        $category=Category::where('published',1)->get();
        $cat=Category::where('id',$c)->where('published',1)->first();
        $catf=1;
         if($cat==null && $category->count()) {
             $cat=$category->first();
            return redirect()->route('gts',['id'=>$id,'c'=>$cat->id]);
         }


         $educ=EducBack::where('a_id',$id)->inRandomOrder()->get();
         $prof=ProfExam::where('a_id',$id)->get();
         $skills=ProfSkills::where('a_id',$id)->get();
         $trainings=Trainings::where('a_id',$id)->get();
         $types=RefTraining::all();
         $honors=Honors::all();
         $exams=Exams::all();
         $ay=Ay::all();
         $colleges=College::take(11)->get();



        return view('main.index',compact('category','id', 'c','cat','catf',
            'educ','honors','ay','colleges','exams','prof','skills'
            ,'trainings','types'));
    }

    //store answers
    public function store(Request $request){
        //return $request->all();
        $answers=array();
        $id=$request->get('a_id');
        //delete
        $cat=Category::where('id',$request->get('cat'))->first();
        foreach ($cat->items as $item){
            $item->answers($request->get('a_id'))->delete();
        }
     foreach ($request->all() as $index=> $ans){

            $ind=explode('-',$index);

            if(count($ind)>=2){
                $item=Item::where('id',$index)->first();
                if($item->answers_type34($id,$ind[1])->count()){
                    $item->answers_type34($id,$ind[1])->first()->update(array(
                        'a_id'=>$id,
                        'item_id'=>$ind[0],
                        'ans_rate'=>$ans,
                        'choice_id'=>$ind[1],
                    ));
                }else {
                    Answers::create(array(
                        'a_id'=>$id,
                        'item_id'=>$ind[0],
                        'ans_rate'=>$ans,
                        'choice_id'=>$ind[1],
                    ));
                }

            }else if($index!='_token' || $index!='a_id' || $index!='cat'){
                $item=Item::where('id',$index)->first();
              if($item!=null) {
                  if ($item->type == 1) {

                      if($item->answers($id)->count()){
                          $item->answers($id)->delete();
                      }
                      if( (strlen($ans)>0))
                          Answers::create(array(
                              'a_id' => $id,
                              'item_id' => $index,
                              'ans' => $ans,
                          ));


                  }else if ($item->type == 2) {
                      if($item->answers($id)->count()){
                          $item->answers($id)->delete();
                      }
                      if($ans!=null)
                          Answers::create(array(
                              'a_id' => $id,
                              'item_id' => $index,
                              'choice_id' => $ans,
                          ));

                  } else if ($item->type == 3) {

                      if($item->answers($id)->count()){
                          $item->answers($id)->delete();
                      }

                      foreach ($ans as $a) {
                          if($a!=-10){
                              Answers::create(array(
                                  'a_id' => $id,
                                  'item_id' => $index,
                                  'choice_id' => $a,
                                  'others' => $a == $item->choices->last()->id ? $request->get('others' . $index) : null,
                              ));
                          }

                      }//end of foreach

                  }else if($item->type==5){
                      if($item->answers($id)->count()){
                          $item->answers($id)->delete();
                      }


                      Answers::create(array(
                              'a_id' => $id,
                              'item_id' => $index,
                              'choice_id' => $ans,
                          ));

                  }
              }//end of $item!=null
            }//end of else for checking type 4
        }
        return back();

    }
    public function loadDeg($id){
        return College::where('college_code',$id)->first()->degrees;
    }

}
