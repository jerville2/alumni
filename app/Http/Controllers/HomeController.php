<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Download;
use App\Event;
use App\News;
use App\Reunion;
use App\SlideShow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = SlideShow::where('published', 1)->get();
        $events = Event::where('published', 1)->latest('date')->take(4)->get();
        $news = News::where('published', 1)->latest('date')->take(4)->get();
        $announcements = Announcement::where('published', 1)->latest('date')->take(4)->get();
        $reunions = Reunion::where('published', 1)->latest('reundate')->take(4)->get();
        $downloads = Download::where('published', 1)->latest('dldate')->get();
        return view('welcome', compact('events', 'news', 'downloads', 'announcements', 'reunions', 'slides'));
    }
}
