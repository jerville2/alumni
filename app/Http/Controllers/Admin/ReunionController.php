<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ReunionRequest;
use App\Reunion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Alert;

class ReunionController extends Controller
{
    public function allReus() {
        $reus = Reunion::latest('reundate')->paginate(25);
        return view('admin.reunions.reunions', compact('reus'));
    }
    public function newReu() {
        return view('admin.reunions.reunion_editor');
    }
    public function editReu($id) {
        $reu = Reunion::where('reun_code', $id)->first();
        return view('admin.reunions.edit_reunion', compact('reu'));
    }
    public function reu(ReunionRequest $request) {
        $pub = $request->pub;
        if ($pub == '1'){
            $pubs = 1;
        } else {
            $pubs = 0;
        }
        $reu = new Reunion;
        $reu->title = $request->title;
        $reu->slug = $request->slug;
        $reu->keywords = $request->keywords;
        $reu->desc = $request->desc;
        $reu->description = $request->contents;
        $reu->published = $pubs;
        $reu->reundate = date('Y-m-d', strtotime($request->pubDate));
        $reu->save();
        Alert::success('Reunion has been saved.', 'Saved');
        return redirect('admin/reunions');
    }
    public function updateReu(Request $request, $id) {
        $pub = $request->pub;
        if ($pub == '1'){
            $pubs = 1;
        } else {
            $pubs = 0;
        }
        $reu = Reunion::find($id);
        $reu->title = $request->title;
        $reu->slug = $request->slug;
        $reu->keywords = $request->keywords;
        $reu->desc = $request->desc;
        $reu->description = $request->contents;
        $reu->published = $pubs;
        $reu->reundate = date('Y-m-d', strtotime($request->pubDate));
        $reu->update();
        Alert::success('Reunion has been saved.', 'Saved');
        return redirect('admin/reunions');
    }
    public function deleteReu($id) {
        Reunion::find($id)->delete();
        Alert::success('Reunion successfully deleted!', 'Deleted');
        return redirect('admin/reunions');
    }
}
