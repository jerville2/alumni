<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\OpportunityRequest;
use App\Opportunity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Alert;

class OpportunityController extends Controller
{
    public function allOpps() {
        $opps = Opportunity::latest('date')->paginate(25);
        return view('admin.opportunities.opportunities', compact('opps'));
    }
    public function newOpp() {
        return view('admin.opportunities.opportunity_editor');
    }
    public function editOpp($id) {
        $opp = Opportunity::where('id', $id)->first();
        return view('admin.opportunities.edit_opportunity', compact('opp'));
    }
    public function opp(OpportunityRequest $request) {
        $pub = $request->pub;
        if ($pub == '1'){
            $pubs = 1;
        } else {
            $pubs = 0;
        }
        $opp = new Opportunity;
        $opp->title = $request->title;
        $opp->slug = $request->slug;
        $opp->keywords = $request->keywords;
        $opp->desc = $request->desc;
        $opp->opportunity = $request->contents;
        $opp->published = $pubs;
        $opp->date = date('Y-m-d', strtotime($request->pubDate));
        $opp->save();
        Alert::success('Job Opportunity has been saved.', 'Saved');
        return redirect('admin/opportunities');
    }
    public function updateOpp(Request $request, $id) {
        $pub = $request->pub;
        if ($pub == '1'){
            $pubs = 1;
        } else {
            $pubs = 0;
        }
        $opp = Opportunity::find($id);
        $opp->title = $request->title;
        $opp->slug = str_slug($request->title);
        $opp->keywords = $request->keywords;
        $opp->desc = $request->desc;
        $opp->opportunity = $request->contents;
        $opp->published = $pubs;
        $opp->date = date('Y-m-d', strtotime($request->pubDate));
        $opp->update();
        Alert::success('Job Opportunity has been saved.', 'Saved');
        return redirect('admin/opportunities');
    }
    public function deleteOpp($id) {
        Opportunity::find($id)->delete();
        Alert::success('Opportunity successfully deleted!', 'Deleted');
        return redirect('admin/opportunities');
    }
}
