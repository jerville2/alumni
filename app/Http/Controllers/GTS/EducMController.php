<?php

namespace App\Http\Controllers\GTS;

use App\Degree;
use App\EducBack;
use App\Generic\Load;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use  App\Http\Controllers\Controller;
class EducMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $content='educM.main';
        $title='Migrate Educational Background';
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
            return $request->file('file')->storeAs('excels', $request->file('file')->getClientOriginalName());
            $j=$l->read( $request->file('file')->storeAs('excels', $request->file('file')->getClientOriginalName()) );

            if(count($j)>=1){
                try{
                    DB::beginTransaction();
                    foreach ($j as $index=>$v){
                        if(($v->college!=0) || ($v->degree!=0) ){
                            if(array_key_exists ($v->degree,$l->loadDegrees()) && array_key_exists($v->college,$l->loadColleges())){

                                if(is_numeric($v->a_id)){

                                    $p=new EducBack(
                                        array(
                                            'a_id'=>$v->a_id,
                                            'college'=>$l->loadColleges()[$v->college],
                                            'degree'=>$l->loadDegrees()[$v->degree],
                                            'honor'=>$v->honor,
                                            'ay'=>$v->ay!=''?$v->ay:0,
                                        )
                                    );
                                    $p->save();

                                }//end of if is_numberic

                            }//end of checking degree

                        }

                    }//end of foreach
                    DB::commit();
                } catch(\Exception $ex){
                    DB::rollback();
                    return back()->with('messages','Something Went Wrong')->with('class','alert alert-warning');

                }

            }

        }else{
            return back()->with('messages','Nothing to migrate')->with('class','alert alert-info');
        }
        return back()->with('messages','Successfully Migrated')->with('class','alert alert-success');
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
