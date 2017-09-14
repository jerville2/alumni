<?php

namespace App\Http\Controllers\GTS;


use App\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }
    public function index()
    {
        //
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
        $item=new Item();
        $item->fill($request->all());
        $item->op_val=$request->get('type')==4?$request->get('rate')+1:null;
        $item->save();
        if($request->get('type')>=2){
            if($request->has('choices')){
                foreach ($request->get('choices') as $choice){

                    $item->addChoices(array(
                        'item_id'=>$item->id,
                        'text'=>$choice,

                    ));
                }
            }
        }
        return back();
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
        if($request->has('desc'))
            Item::find($id)->update(array('desc'=>$request->get('desc')));
        return back();
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

        $item=Item::where('id',$id)->first();
        $item->choices()->delete();
        $item->answer()->delete();
        $item->hr()->delete();
        $item->h()->delete();
        $item->delete();
        return back();
    }
}
