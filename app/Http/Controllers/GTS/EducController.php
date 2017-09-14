<?php

namespace App\Http\Controllers\GTS;

use App\EducBack;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
class EducController extends Controller
{
    //
    public function edit($id){

    }
    public function store(Request $request){
        //return $request->all();
        $ed=new EducBack();
        $ed->fill($request->all());
        $ed->save();

    }
    public function destroy($id, Request $request){
        if (EducBack::where('id',$id)->count())
             EducBack::where('id',$id)->first()->delete();

        //return back();
    }
    public function loadEduc($id){
        $educ=EducBack::where('a_id',$id)->get();

        return view('tables.educ-table',compact('educ'));
    }
}
