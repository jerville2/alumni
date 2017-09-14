<?php

namespace App\Http\Controllers;

use App\Album;
use App\Announcement;
use App\Download;
use App\Event;
use App\News;
use App\Opportunity;
use App\Reunion;
use App\SlideShow;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function home() {
        $slides = SlideShow::where('published',1)->get();
        $events = Event::where('published', 1)->latest('date')->take(4)->get();
        $news = News::where('published', 1)->latest('date')->take(4)->get();
        $announcements = Announcement::where('published', 1)->latest('date')->take(4)->get();
        $reunions = Reunion::where('published', 1)->latest('reundate')->take(4)->get();
        $downloads = Download::where('published', 1)->latest('dldate')->get();
        return view('welcome', compact('events', 'news', 'downloads', 'announcements', 'reunions', 'slides'));
    }

    public function events($slug) {
        $event = Event::where('slug', $slug)->first();
        return view('post.event', compact('event'));
    }
    public function news($slug) {
        $news = News::where('slug', $slug)->first();
        return view('post.news', compact('news'));
    }
    public function ann($slug) {
        $ann = Announcement::where('slug', $slug)->first();
        return view('post.ann', compact('ann'));
    }
    public function reu($slug) {
        $reu = Reunion::where('slug',$slug)->first();
        return view('homecoming.reu', compact('reu'));
    }
    public function job($id) {
        $job = Opportunity::where('slug', $id)->first();
        return view('post.job', compact('job'));
    }

    public function eventsAll() {
        $events = Event::where('published', 1)->latest('date')->paginate(10);
        return view('post.all_events', compact('events'));
    }
    public function newsAll() {
        $allNews = News::where('published', 1)->latest('date')->paginate(10);
        return view('post.all_news', compact('allNews'));
    }
    public function annAll() {
        $anns = Announcement::where('published', 1)->latest('date')->paginate(10);
        return view('post.all_ann', compact('anns'));
    }
    public function jobsAll() {
        $jobs = Opportunity::where('published', 1)->latest('date')->paginate(10);
        return view('post.all_jobs', compact('jobs'));
    }
    public function galleryAll() {
        $galleries = Album::latest('id')->where('published', 1)->get();
        return view('post.all_galleries', compact('galleries'));
    }
    public function imageAll($id) {
        $images = Album::find($id);
        return view('post.all_image', compact('images'));
    }
    public function reuAll() {
        $reus = Reunion::where('published', 1)->latest('reundate')->paginate(10);
        return view('homecoming.reu_all', compact('reus'));
    }

    public function search(Request $request) {
        $page = Input::get('page', 1);
        $paginate = 10;
        $term = $request->search;
        $anns = DB::table('announcements')
            ->select('id', 'title', 'date', 'type', 'announcement', 'slug')
            ->where('title', 'like', '%'.$term.'%');
        $events = DB::table('events')
            ->select('id', 'title', 'date', 'type', 'event', 'slug')
            ->where('title', 'like', '%'.$term.'%');
        $news = DB::table('news')
            ->select('id', 'headline', 'date', 'type', 'news', 'slug')
            ->where('keywords', 'like', '%'.$term.'%')
            ->union($anns)
            ->union($events)
            ->orderBy('date', 'desc')
            ->get();

        $offSet = ($page * $paginate) - $paginate;
        $results = new LengthAwarePaginator($news->slice($offSet,$paginate,$page),
            count($news), $paginate,  $page, ['path' => $request->url(), 'query' => $request->query()]);


        return view('post.result', compact('results'));

    }

    public function about() {
        return view('about_us.about');
    }
    public function org() {
        return redirect('about_us')->withInput(['tab'=>'organization']);
    }
    public function coor() {
        return redirect('about_us')->withInput(['tab'=>'coordinators']);
    }
    public function faai() {
        return redirect('about_us')->withInput(['tab'=>'faai']);
    }
    public function services() {
        return view('services.services');
    }
    public function idcard() {
        return redirect('services')->withInput(['tab' => 'idcard']);
    }

    public function download($id) {
        $download = Download::find($id);

        $extension = File::extension($download->src);
        //$file = public_path($download->src);
        //$file = Storage::get($download->src);
        return response()->download(storage_path('app/'.$download->src), $download->title.'.'.$extension);
    }


}
