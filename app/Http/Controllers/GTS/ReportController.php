<?php

namespace App\Http\Controllers\GTS;

use App\Alumni;
use App\Answers;
use App\Ay;
use App\Choices;
use App\College;
use App\FiltersRepository\AnswersFilters;
use App\FiltersRepository\ChoicesFilters;
use App\EducBack;
use App\FiltersRepository\Counter;
use App\FiltersRepository\Filter1;
use App\FiltersRepository\Filter2;
use App\FiltersRepository\ReportFilters;
use App\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel ;
use  App\Http\Controllers\Controller as Controller;
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $content='reports.report-ui';
        $rep=null;
        $item=null;
        $yg=Alumni::where('year_graduated','!=',0)->distinct()->orderBy('year_graduated')->get(['year_graduated']);
       // return $yg->pluck('year_graduated','year_graduated');
        return view('reports.index',compact('content','rep','item','col'));
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
       $id=$request->get('items');
       return redirect()->route('report.show',['id'=>$id,'in'=>$request->all()] )->withInput($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request,ReportFilters $filter)
    {

        ini_set('memory_limit','256M');
        $items=Item::all();
        $item=Item::where('id',$id)->first();
        $content='reports.report-ui';

        $ay=$request->get('in')['yg'];
        $to=null;//$request->get('in')['to'];
        $from=null;//$request->get('in')['from'];


        $sub_content=null;

        if(!(array_key_exists('college',$request->get('in'))==0))
            $col=College:: where('college_code',$request->get('in')['college'])->first();
        else
            $col=College::where('id',4)->first();
        $degs=Alumni::where('college_code',$col->college_code)->where('year_graduated',$ay)
            ->where('degree_code','!=',0)->distinct()
            ->with('degs')->get(['degree_code as degree']);
        //$rep=array();
        //$res=array();
        $flag=0;

       if($item->type==4){
           $sql=array(
               'choices.id','choices.text','answers.a_id','college_code as college ','degree_code as degree',
               'year_graduated','answers.ans_rate',
           );
            $ch=Choices::where('choices.item_id',$id)->filterType4(
                array(
                    'college'=>$col,
                    'sql'=>$sql,
                    'ay'=>$ay,
                )
            );
           $ch=$ch->get();
            //return $ch;
           $flag=1;
           $lim= $item->op_val;
           $res=$filter->fil(new Filter2(),$ch,$degs,$lim,$item->desc);

           $sub_content='reports.table2';
       }else if($item->type==1){
           $ans=Answers::where('item_id',$item->id);
           $ans->filter(array(
               'college'=>$col,
               'ay'=>$ay,
           ));
           $ans=$ans->get();

           $res=$filter->fil(new Filter3(),$ans,$degs,null,$item->desc);
           //return $ans;
           $sub_content='reports.table4';

       }else{
           $sub_content='reports.table3';
            $sql=array(
              'choices.id','choices.text','answers.a_id','college_code as college ','degree_code as degree',
                'year_graduated'
          );
         $ch=Choices::where('choices.item_id',$item->id)->filter(array(
             'college'=>$col,
             'sql'=>$sql,
             'ay'=>$ay,
         ));
         $ch=$ch->get();
         //return $ch;
         $res=$filter->fil(new Filter1(),$ch,$degs,null,$item->desc);

       }//end of else

        $rep=$res[1];

        $tc=$res[0];
        $ex_arra=$res[2];

        $time=Carbon::now()->format('Ydhis');
        $file="exports".preg_replace('/\?/','',$item->desc).$time;
        $filename=$file.'.xls';

        if($ex_arra!=null)
                Excel::create($file, function($excel) use($ex_arra,$degs,$flag) {
                    $excel->setTitle('Our new awesome title');
                    if($flag==0){
                        $excel->sheet('Test', function($sheet) use ($ex_arra){

                            $sheet->fromArray($ex_arra);

                        });
                    }else{

                        foreach ($degs as $d){
                            $excel->sheet($d->degs->degree, function($sheet) use ($ex_arra,$d){

                                $sheet->fromArray($ex_arra[$d->degree]);

                            });
                        }
                    }


                })->store('xls',public_path('excel/exports'));

       return view('reports.index',
                compact('content','items','rep','item',
                        'col',
                        'sub_content',
                        'degs','to','from','tc','filename'
           ));

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
    public function download($file){

        //Session::flash('download.in.the.next.request','dl');
        //$path=public_path('exports').'\\'.$request->get('filename');
        $path=public_path('excel\exports').'\\'.$file;
        return response()->download($path);
    }
    public function loadChoices($id){
          $years=array();
          for ($i=$id;$i<=Carbon::now()->format('Y');$i++)
              $years[$i]=$i;
          array_reverse($years);
           return view('reports.years',compact('years'));
    }

}
