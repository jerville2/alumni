<?php

namespace App\Http\Controllers;

use App\Alumni;
use App\College;
use App\Degree;
use App\Events\PostReported;
use App\Like;
use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DirectoryController extends Controller
{

    public function degreeMap() {
        $id = Input::get('option');
        if($id==0){
            return 0;
        }
        $college = College::find($id);
        $degrees = $college->degrees();

        return $degrees->pluck('abbr', 'id');
    }

    public function allAlumni() {
        $alumni = Alumni::latest('id')->where('firstname', '<>', 'MMSU')->paginate(25);
        $colleges = College::all();
        $value = Session::put(['sch' => '','col' => '','deg' => '','yr' => '','sem' => '', 'coln' => '', 'degn' => '', 'semn' => '']);
        return view('directory.alumni', compact('alumni', 'colleges', 'value'));
    }
    public function searchAlum(Request $request) {
        $colleges = College::all();
        $page = Input::get('page', 1);
        $paginate = 25;
        $term = $request->search;
        $col = $request->college;
        $deg = $request->degree;
        $year = $request->year;
        $sem = $request->sem;
        if ($deg == 0){
            $deg = '';
        }
        if ($col == null){
            $coln = '';
        } else {
            $colsn = College::find($col);
            $coln = $colsn->college;
            $degrees = $colsn->degrees()->get();
        }

        if($deg != null){
            $degsn = Degree::find($deg);
            $degn = $degsn->abbr;
        } else {
            $degn = '';
        }

        if ($sem == 1){
            $semn = '1st Sem.';
        } else if ($sem == 2){
            $semn = '2nd Sem.';
        } else{
            $semn = 'Midyear';
        }

        $results = Alumni::where(
            function ($query) use ($term){
                $query->where('firstname', 'like', '%'.$term.'%')
                    ->orWhere('middlename', 'like', '%'.$term.'%')
                    ->orWhere('surname', 'like', '%'.$term.'%');
            })->where([
            ['college_code', 'like', '%'.$col.'%'],
            ['degree_code', 'like', '%'.$deg.'%'],
            ['year_graduated', 'like', '%'.$year.'%'],
            ['sem_graduated', 'like', '%'.$sem.'%'],
            ['firstname', '<>', 'MMSU'],
            ['surname', '<>', 'RELATIONS'],
            ['middlename', '<>', 'ALUMNI'],
        ])
            ->orderBy('surname')
            ->get();
        $offSet = ($page * $paginate) - $paginate;
        $alumni = new LengthAwarePaginator($results->slice($offSet,$paginate,$page),
            count($results), $paginate,  $page, ['path' => $request->url(), 'query' => $request->query()]);
        $value = Session::put(['sch' => $term,'col' => $col,'deg' => $deg,'yr' => $year,'sem' => $sem, 'coln' => $coln, 'degn' => $degn, 'semn' => $semn]);

        return view('directory.alumni',
            compact('alumni', 'value', 'colleges', 'degrees'));
    }
    public function viewProfile($id) {
        $user = User::find($id);
        $alumni = Alumni::where('year_graduated', 'like', Auth::user()->alumni->year_graduated)
            ->orWhere('college_code', 'like', Auth::user()->alumni->college_code)
            ->orderBy(DB::raw('RAND()'))->take(5)->get();
        return view('directory.profile', compact('user', 'alumni'));
    }
    public function timeLine(){
        $posts = Post::latest('date')->paginate(3);
        $colleges = College::all();
        $report = DB::table('post_report')->get();
        $alumni = Alumni::orderBy(DB::raw('RAND()'))->take(3)->get();
        $value = Session::put(['sch' => '','col' => '','deg' => '','yr' => '','sem' => '', 'coln' => '', 'degn' => '', 'semn' => '']);
        return view('directory.timeline', compact('posts', 'colleges', 'value', 'alumni', 'report'));
    }
    public function viewPost($id) {
        $post = Post::find($id);
        $colleges = College::all();
        $value = Session::put(['sch' => '','col' => '','deg' => '','yr' => '','sem' => '', 'coln' => '', 'degn' => '', 'semn' => '']);
        return view('directory.post', compact('post', 'colleges', 'value'));
    }
    public function report(Request $request) {
        $id = $request->postId;
        $name = Auth::user()->alumni->firstname.' '.Auth::user()->alumni->middlename.' '.Auth::user()->alumni->surname;

        $post = Post::where('id',$id)->first();
        $post->report = 1;
        $post->report_id = $request->report;
        $post->report_msg = $request->comment;
        $post->rname = $name;
        $post->reported_by = Auth::user()->id;
        $post->date_reported = Carbon::now();
        $post->save();

        event(new PostReported($name,$id));
        return back();
    }
    public function viewNotification($id) {
        $like = Like::find($id);
        $like->viewed = 1;
        $like->update();

        return redirect('alumni/post/'.$like->post_id);
    }
    public function markAll() {
        $likes = Like::where('owner',Auth::user()->id);
        foreach ($likes as $like) {
            $like->viewed = 1;
            $like->update();
        }
        return back();
    }
}
