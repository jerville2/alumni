<?php

namespace App\Http\Controllers\GTS;

use App\Category;
use App\Types;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller as Controller;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $content='category.main';
        return view('category.index',compact('content'));
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
        $cat=new Category();
        $cat->fill($request->all());
        $cat->save();
        return back()->with('message','successfully add category')->with('class','alert alert-success');

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
        $cat=Category::where('id',$id)->first();
        $types=Types::all();
        $content="category.show";
        $catf=0;

        return view('category.index',compact('cat','content','types','catf'));

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
        $cat=Category::where('id',$id)->first();
        $types=Types::all();
        $content="category.show";
        return view('category.index',compact('cat','content','types'));
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
        $cat=Category::where('id',$id)->first();
        $cat->fill($request->all());
        $cat->save();
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
        try{
            DB::beginTransaction();
                $cat=Category::find($id);
                foreach ($cat->items as $item){
                    $item->answer()->delete();
                    $item->choices()->delete();
                    $item->delete();
                }
                $cat->delete();
            DB::commit();
        }catch (\Exception $ex){
            DB::rollback();
            return back()->with('messages','Something went wrong')->
                with('class','alert alert-danger');
        }
        return back()->with('messages','Category deleted')->
             with('class','alert alert-success');


    }
}
