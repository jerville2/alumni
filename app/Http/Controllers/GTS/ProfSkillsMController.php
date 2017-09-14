<?php

namespace App\Http\Controllers\GTS;

use App\Generic\Load;
use App\ProfSkills;
use App\Skills;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
class ProfSkillsMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $content='profskills.main';

        return view('gen.migrate_index',compact('content'));
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
                       if($v->skill!="" ){
                           $p=new ProfSkills(
                               array(
                                   'a_id'=>$v->a_id,
                                   'skill'=>$v->skill,
                               )
                           );
                           $p->save();
                       }

                   }
                   DB::commit();

               }catch (\Exception $ex){

                    DB::rollback();
                   return back()->with('messages','Something went wrong')->with('class','alert alert-danger');
               }//end of catch
            }

        }else{
            return back()->with('messages','Nothing to migrate')
                ->with('class','alert alert-info');
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
