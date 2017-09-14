<?php

namespace App\Http\Controllers\GTS;

use App\Generic\Load;
use App\ProfExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
class ProfExamMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $content='profExamM.main';
        $title='Migrate Prof. Exams';
        return view('gen.migrate_index',compact('content','title'));
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
        //
        if($request->hasFile('file')){
            $l=new Load();
            $j=$l->read( $request->file('file')->storeAs('excels', $request->file('file')->getClientOriginalName()) );

            //choice id and choice
            if(count($j)>=1){
                try{
                    DB::beginTransaction();

                        foreach ($j as $index=>$v){

                            if(is_numeric($v->a_id)){
                                $p=new ProfExam(
                                    array(
                                        'exam'=>$v->exam,
                                        'a_id'=>$v->a_id,
                                        'date_exam'=>$v->date,
                                        'rating'=>$v->rating
                                    )
                                );
                                $p->save();
                            }//end of is numeric

                        }

                    DB::commit();
                }catch (\Exception $ex){
                    DB::rollback();
                    return back()->with('messages','Something has gone horribly wrong')->
                        with('class','alert alert-danger');
                }
            }//end of if count

        }else {
            return back()->with('messages','Nothing to Migrate')->
                     with('class','alert alert-info');
        }
        return back()->with('messages','Successfully migrated')->
            with('class','alert alert-success');
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
        //
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
