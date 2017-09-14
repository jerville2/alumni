<?php

namespace App\Http\Controllers\Admin;

use App\Announcement;
use App\Http\Requests\Admin\AnnouncementRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Alert;

class AnnouncementController extends Controller
{
    public function allAnns() {
        $anns = Announcement::latest('date')->paginate(25);
        return view('admin.announcements.announcements', compact('anns'));
    }
    public function newAnn() {
        return view('admin.announcements.announcement_editor');
    }
    public function editAnn($id) {
        $ann = Announcement::where('id', $id)->first();
        return view('admin.announcements.edit_announcement', compact('ann'));
    }
    public function ann(AnnouncementRequest $request) {
        $pub = $request->pub;
        if ($pub == '1'){
            $pubs = 1;
        } else {
            $pubs = 0;
        }
        $ann = new Announcement;
        $ann->title = $request->title;
        $ann->slug = $request->slug;
        $ann->keywords = $request->keywords;
        $ann->desc = $request->desc;
        $ann->announcement = $request->contents;
        $ann->published = $pubs;
        $ann->date = date('Y-m-d', strtotime($request->pubDate));
        $ann->save();
        Alert::success('Announcement has been saved.', 'Saved');
        return redirect('admin/announcements');
    }
    public function updateAnn(Request $request, $id) {
        $pub = $request->pub;
        if ($pub == '1'){
            $pubs = 1;
        } else {
            $pubs = 0;
        }
        $ann = Announcement::find($id);
        $ann->title = $request->title;
        $ann->slug = $request->slug;
        $ann->keywords = $request->keywords;
        $ann->desc = $request->desc;
        $ann->announcement = $request->contents;
        $ann->published = $pubs;
        $ann->date = date('Y-m-d', strtotime($request->pubDate));
        $ann->update();
        Alert::success('Announcement has been saved.', 'Saved');
        return redirect('admin/announcements');
    }
    public function deleteAnn($id) {
        Announcement::find($id)->delete();
        Alert::success('Announcement successfully deleted!', 'Deleted');
        return redirect('admin/announcements');
    }
}
