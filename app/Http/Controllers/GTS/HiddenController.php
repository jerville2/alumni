<?php

namespace App\Http\Controllers\GTS;

use App\Category;
use App\Hidden;
use App\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
class HiddenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $h=new Hidden();
        $h->fill($request->all());
        $h->save();
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

        $item=Item::where('id',$id)->first();
       // return Category::where('id',$item->cat_id)->get()->first()->itemsType($id)->count();
        if(Category::where('id',$item->cat_id)->first()->itemsType($id)->count()>=1){
            $content='hidden.main';
            $items=Item::where('cat_id',$item->cat_id)
                ->where('id','!=',$item->id)
                ->where(function ($query){
                    $query->where('type',2);
                    $query->orwhere('type',5);
                })
                ->get();
        }else
            return back();


        return view('hidden.index',compact('item','content','items'));
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
        $h=Hidden::where('id',$id)->first();
        $h->delete();
        return back();
    }
    public function loadChoices($id){
       return Item::where('id',$id)->first()->choices;
    }
}
