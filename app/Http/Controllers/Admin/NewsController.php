<?php

namespace App\Http\Controllers\Admin;

use App\News;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\NewsRequest;
use App\Http\Controllers\Controller;
use Alert;

class NewsController extends Controller
{
    public function allNews() {
        $news = News::latest('date')->paginate(25);
        return view('admin.news.news', compact('news'));
    }
    public function newNews() {
        return view('admin.news.news_editor');
    }
    public function editNews($id) {
        $news = News::where('id', $id)->first();
        return view('admin.news.edit_news', compact('news'));
    }
    public function news(NewsRequest $request) {
        $pub = $request->pub;

        if ($pub == '1'){
            $pubs = 1;
        } else {
            $pubs = 0;
        }

        $news = new News;
        $news->headline = $request->title;
        $news->slug = $request->slug;
        $news->keywords = $request->keywords;
        $news->desc = $request->desc;
        $news->news = $request->contents;
        $news->published = $pubs;
        $news->date = date('Y-m-d', strtotime($request->pubDate));
        $news->save();
        Alert::success('News has been saved.', 'Saved');
        return redirect('admin/news');
    }
    public function updateNews(Request $request, $id) {
        $pub = $request->pub;

        if ($pub == '1'){
            $pubs = 1;
        } else {
            $pubs = 0;
        }

        $news = News::find($id);
        $news->headline = $request->title;
        $news->slug = $request->slug;
        $news->keywords = $request->keywords;
        $news->desc = $request->desc;
        $news->news = $request->contents;
        $news->published = $pubs;
        $news->date = date('Y-m-d', strtotime($request->pubDate));
        $news->update();
        Alert::success('News has been saved.', 'Saved');
        return redirect('admin/news');
    }
    public function deleteNews($id) {
        News::find($id)->delete();
        Alert::success('News successfully deleted!','Deleted!');
        return redirect('admin/news');
    }
}
