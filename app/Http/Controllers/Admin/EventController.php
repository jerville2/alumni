<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use App\Http\Requests\Admin\EventRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Alert;

class EventController extends Controller
{
    public function allEvents() {
        $events = Event::latest('date')->paginate(25);
        return view('admin.events.events', compact('events'));
    }
    public function newEvent() {
        return view('admin.events.event_editor');
    }
    public function editEvent($id) {
        $event = Event::where('id', $id)->first();
        return view('admin.events.edit_event', compact('event'));
    }
    public function event(EventRequest $request) {
        $pub = $request->pub;

        if ($pub == '1'){
            $pubs = 1;
        } else {
            $pubs = 0;
        }

        $event = new Event;
        $event->title = $request->title;
        $event->slug = $request->slug;
        $event->keywords = $request->keywords;
        $event->desc = $request->desc;
        $event->event = $request->contents;
        $event->published = $pubs;
        $event->date = date('Y-m-d', strtotime($request->pubDate));
        $event->save();
        Alert::success('Event has been saved.', 'Saved');
        return redirect('admin/events');
    }
    public function updateEvent(Request $request, $id) {
        $pub = $request->pub;

        if ($pub == '1'){
            $pubs = 1;
        } else {
            $pubs = 0;
        }

        $event = Event::find($id);
        $event->title = $request->title;
        $event->slug = $request->slug;
        $event->keywords = $request->keywords;
        $event->desc = $request->desc;
        $event->event = $request->contents;
        $event->published = $pubs;
        $event->date = date('Y-m-d', strtotime($request->pubDate));
        $event->update();
        Alert::success('Event has been saved.', 'Saved');
        return redirect('admin/events');
    }
    public function deleteEvent($id) {
        Event::find($id)->delete();
        Alert::success('Event successfully deleted!','Deleted!');
        return redirect('admin/events');
    }
}
