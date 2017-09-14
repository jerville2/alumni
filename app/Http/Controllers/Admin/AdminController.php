<?php

namespace App\Http\Controllers\Admin;

use App\Alumni;
use App\Post;
use App\Receipt;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;
use Alert;

class AdminController extends Controller
{
    public function allUsers() {
        $users = Alumni::latest('id')->where('firstname','<>', 'MMSU')->paginate(25);
        return view('admin.users.users', compact('users'));
    }
    public function userInfo($id) {
        $user = User::find($id);
        return view('admin.users.user_info', compact('user'));
    }
    public function userPayment(Request $request, $id) {
        $rec = new Receipt;
        $rec->orcode = $request->orcode;
        $rec->datepaid = date('Y-m-d', strtotime($request->date));
        $rec->payment = $request->amount;
        $rec->reg_id = $id;
        $rec->save();

        return redirect('admin/users/info/'.$id);
    }
    public function userClaim(Request $request, $id) {

        $rec = Receipt::where('reg_id', $id)->first();
        $date = date('Y-m-d', strtotime($request->dateEffect));
        if($rec->payment > 1000){
            $due_date = Carbon::createFromFormat('Y-m-d', $date)->addYears(5);
        } else {
            $due_date = Carbon::createFromFormat('Y-m-d', $date)->addYears(2);
        }

        $alumni = Alumni::where('reg_id', $id)->first();
        $alumni->idcard = 1;
        $alumni->dateclaimed = date('Y-m-d', strtotime($request->date));
        $alumni->claimed_by = $request->name;
        $alumni->effect_date = $date;
        $alumni->due_date = date('Y-m-d', strtotime($due_date));
        $alumni->save();

        return redirect('admin/users/info/'.$id);
    }
    public function search(Request $request) {
        $page = Input::get('page', 1);
        $paginate = 25;
        $term = $request->search;

        $alum = Alumni::where('firstname', 'like', '%'.$term.'%')
            ->orWhere('middlename', 'like', '%'.$term.'%')
            ->orWhere('surname', 'like', '%'.$term.'%')
            ->orWhere('student_number', 'like', '%'.$term.'%')
            ->orderBy('surname', 'ASC')
            ->get();

        $offSet = ($page * $paginate) - $paginate;
        $users = new LengthAwarePaginator($alum->slice($offSet,$paginate,$page),
            count($alum), $paginate,  $page, ['path' => $request->url(), 'query' => $request->query()]);
        return view('admin.users.users', compact('users'));
    }

    public function allPost() {
        $posts = Post::latest('date')->where('report', 1)->paginate(10);
        return view('admin.post.post', compact('posts'));
    }
    public function viewPost($id) {
        $post = Post::find($id);
        $user = User::find($post->reported_by);
        return view('admin.post.view', compact('post', 'user'));
    }
    public function allowPost($id) {
        $post = Post::find($id);
        $post->report = 0;
        $post->save();
        Alert::success('Post Allowed');
        return redirect('admin/post');
    }
    public function deletePost($id) {
        $post = Post::find($id);
        $post->delete();

        Alert::success('Post Deleted');
        return redirect('admin/post');
    }
}
