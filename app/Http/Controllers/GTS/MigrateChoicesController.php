<?php

namespace App\Http\Controllers\GTS;

use App\Category;
use App\Choices;
use App\Item;
use Dompdf\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Excel;
use App\Generic\Load;
use App\Http\Controllers\Controller;
class MigrateChoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cat=Category::where('published',1)->get();

        $content='choices.main';
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
        $message='Successfully Migrated';
        $class='alert alert-success';
        if($request->hasFile('file')) {
            $l=new Load();
           $j=$l->read( $request->file('file')->storeAs('upload', $request->file('file')->getClientOriginalName()) );
            $item = Item::where('id', $request->get('item'))->first();
            try{
                if (count($j) >= 1) {
                   DB::beginTransaction();
                    foreach ($j as $index => $v) {
                        if($item->choices->count())
                            $item->choices()->delete();

                        $item->addChoices(
                            array(
                                'text' => $v->choice,
                                'item_id' => $request->get('item'),
                                'old_id' => $v->id,

                            )
                        );

                    }//end of foreach

                    DB::commit();

                }//end of if

            }catch (\Exception $ex){
                DB::rollback();
                $message='Something Went Wrong';
                $class='alert alert-danger';
            }

        }else{
            $message='Nothing to migrate';
            $class='alert alert-info';

        }


        return back()->with('messages',$message)->with('class',$class);
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
    //load choices
    public function loadItems($id,Request $request){
        $items=Item::where('cat_id',$id);
        if($request->get('route')=='migrateChoices.index')
           $items=$items ->where('type','!=',1)->get();
        else
            $items=$items->get();
        return view('gen.items',compact('items'));
    }
}
