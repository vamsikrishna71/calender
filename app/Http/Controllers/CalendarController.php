<?php

namespace App\Http\Controllers;
use App\Models\Events;
use Spatie\GoogleCalendar\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function index() {
        $events = Events::all();
        return view('calendar', ['events' => $events]);
    }

    public function createEvent(Request $request) {

        //Google calendar
        $event = new Event;
        $event->name = $request->input('title');
        $event->startDateTime = Carbon::parse($request->input('startDate'));
        $event->endDateTime = Carbon::parse($request->input('endDate'));
        $newEvent = $event->save();

        //Database
        $query = DB::table('events')->insert([
            'google_calendar_event_id'=> $newEvent->id,
            'title'=>$request->input('title'),
            'start'=>$request->input('startDate'),
            'end'=>$request->input('endDate'),
        ]);
        if($query) {
            return back()->with('createSuccess', 'Event created');
        }
        else {
            return back()->with('createFail', 'Something went wrong');
        }
    }

    public function editEvent(Request $request) {

        //Database
        $editItem = Events::find($request->id);
        $editItem->title = $request->title;
        $editItem->start = $request->startDate;
        $editItem->end = $request->endDate;
        $editItem->save();

        //Google calendar
        $event = Event::find($editItem->google_calendar_event_id);
        $event->name = $editItem->title;
        $event->startDateTime = Carbon::parse($editItem->start);
        $event->endDateTime = Carbon::parse($editItem->end);
        $event->save();
        return back()->with('editSuccess', 'Event edited');;
    }

    public function deleteEvent(Request $request) {

        //Database
        $deleteItem = Events::find($request->id);
        $deleteItem->delete();

        //Google calendar
        $event = Event::find($deleteItem->google_calendar_event_id);
        $event->delete();
        return back()->with('deleteSuccess', 'Event deleted');;
    }
}
