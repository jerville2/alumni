<?php

namespace App\Http\Controllers\GTS;

use App\Answers;
use App\Choices;
use App\Generic\Load;
use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
class AnswerMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items=Item::all();
        $content='answersM.main';
        return view('gen.migrate_index',compact('items','content'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message='Migrated Successfully ';
        $class='alert alert-success';
        if($request->hasFile('file')){
            $l=new Load();
            $c=0;
            $j=$l->read( $request->file('file')->storeAs('excels', $request->file('file')->getClientOriginalName()) );
            $item=Item::where('id',$request->get('item'))->first();
            try{
                if(count($j)>=1){
                    $indecies=array();
                    if($item->answer()->count()){
                        $item->answer()->delete();
                    }
                    DB::beginTransaction();
                    foreach ($j as $index=>$v){

                        //a_id,choice,others
                        $data=array();
                        if($item->type==3){

                            $id=Choices::where('item_id',$item->id)->where('old_id',$v->choice)->first(['id']);
                            if($id!=null){
                                $data=[
                                    'a_id'=>$v->a_id,
                                    'item_id'=>$item->id,
                                    'choice_id'=>$id!=null?$id->id:0,
                                    'others'=>$v->others,
                                ];
                                Answers::create($data);
                                $c++;
                            }



                        }else if($item->type==4){
                            $i=0;
                            foreach ($v as $index => $f){
                                if($i==0)
                                    $a_id = $f;
                                if($i>=1 && is_numeric($a_id)){
                                    $id= Choices::where('item_id',$item->id)->where('old_id',$i)->first(['id']);
                                    if($id!=null) {
                                        $data = [
                                            'a_id' => $a_id,
                                            'item_id' => $item->id,
                                            'choice_id' => $id != null ? $id->id : 0,
                                            'ans_rate' => $f,
                                        ];
                                        // return $data;
                                    }
                                    Answers::create($data);
                                    $c++;
                                }
                                $i++;

                            }

                        }else if($item->type==1){



                                $data=[
                                    'a_id'=>$v->a_id,
                                    'item_id'=>$item->id,
                                    'ans'=>$v->ans,
                                ];
                                Answers::create($data);

                            $c++;
                        }else if($item->type==2 || $item->type==5){
                           $id= Choices::where('item_id',$item->id)->where('old_id',$v->choice)->first(['id']);
                            if($id!=null){

                                $data=[
                                    'a_id'=>$v->a_id,
                                    'item_id'=>$item->id,
                                    'choice_id'=>$id!=null?$id->id:0,
                                ];
                                Answers::create($data);
                                $c++;
                            }


                        }

                    }//end of foreach
                   DB::commit();
                }
                if($c<=0){
                    $message='Nothing went wrong but no records were migrated';
                    $class='alert alert-warning';
                }

            }catch (\Exception $ex){
                DB::rollback();
                $message='Something went wrong \n'.$ex;
                $class='alert alert-warning';
                //return back()->with('messages',$message.$ex)
               //     ->with('class',$class);
            }//end of catch

        }else{
            $message='Nothing was migrated';
            $class='alert alert-info';
        }


            return back()->with('messages',$message)
                ->with('class',$class);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
