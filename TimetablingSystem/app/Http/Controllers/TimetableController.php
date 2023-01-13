<?php

namespace App\Http\Controllers;

use App\Models\Timetable;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    public function index()
    { //fetch all records and display lists
        $data = Timetable::get();
        //compact is to pass $data basically
        return view('/office-assistant/timetable/timetable-list', compact('data'));
    }

    public function addTimetable()
    {
        return view('/office-assistant/timetable/add-timetable');
    }

    public function saveTimetable(Request $request)
    {
//        Validation
        $request->validate([
            'program_id' => 'required',
            'course_id' => 'required',
            'venue_id' => 'required',
            'holiday_id' => 'required',
            'slots' => 'required|date|date_format:Y-m-d',
        ]);

        $program_id = $request->program_id;
        $course_id = $request->course_id;
        $venue_id = $request->venue_id;
        $holiday_id = $request->holiday_id;
        $slots = $request->slots;

//        Create a model in our Eloquent Model Program
        $timetabledata = new Timetable();
        $timetabledata->program_id = $program_id;
        $timetabledata->course_id = $course_id;
        $timetabledata->venue_id = $venue_id;
        $timetabledata->holiday_id = $holiday_id;
        $timetabledata->slots = $slots;
        $timetabledata->save();

        return redirect()->back()->with('success', 'Successful: Timetable entity has been created successfully');
    }

    public function editTimetable($id)
    {
        $data = Timetable::where('id', '=', $id)->first();
        return view('/office-assistant/timetable/edit-timetable', compact('data'));
    }

    public function updateTimetable(Request $request)
    {
        //        Validation
        $request->validate([
            'program_id' => 'required',
            'course_id' => 'required',
            'venue_id' => 'required',
            'holiday_id' => 'required',
            'slots' => 'required|date|date_format:Y-m-d',
        ]);

        $id = $request->id;
        $program_id = $request->program_id;
        $course_id = $request->course_id;
        $venue_id = $request->venue_id;
        $holiday_id = $request->holiday_id;
        $slots = $request->slots;

//        Create the update query by calling our Course Eloquent Model
        Timetable::where('id', '=', $id)->update([
            'program_id' => $program_id,
            'course_id' => $course_id,
            'venue_id' => $venue_id,
            'holiday_id' => $holiday_id,
            'slots' => $slots
        ]);

        return redirect()->back()->with('success', 'Successful: Timetable entity has been updated successfully');
    }

    public function deleteTimetable($id)
    {
        Timetable::where('id', '=', $id)->delete();
        return redirect()->back()->with('success', 'Successful: Timetable entity has been deleted successfully');
    }
}
