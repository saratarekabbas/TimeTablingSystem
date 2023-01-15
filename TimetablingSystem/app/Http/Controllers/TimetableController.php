<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Program;
use App\Models\Timetable;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    public function index()
    { //fetch all records and display lists
        $timetable = Timetable::get();
        //compact is to pass $data basically
        return view('/office-assistant/timetable/timetable-list', compact('timetable'));
    }

    public function addTimetable()
    {
        $courses = Course::get();
//        $programs = Program::all();
        //compact is to pass $data basically
//        return view('/office-assistant/timetable/add-timetable', compact('courses', 'programs'));
        return view('/office-assistant/timetable/add-timetable', compact('courses'));
    }


//    public function filterProgram($program)
//    {
//        $findProgram = Program::where('id', $program)->first();
//        $courses = Course::where('program_id', $findProgram->id)->get();
//        $programs = Program::all();
//        //compact is to pass $data basically
//        return view('/office-assistant/timetable/add-timetable', compact('courses', 'programs'));
//    }

    public function saveTimetable(Request $request)
    {
       //        Validation
        $request->validate([
//            'program_id' => 'required',
            'course_id' => 'required',
            'venue_id' => 'required',
        ]);

        $course_id = $request->course_id;
        $venue_id = $request->venue_id;
        $program_id = Course::where('id', '=', $course_id)->first()->program_id;

//        Create a model in our Eloquent Model Program
        $timetabledata = new Timetable();
        $timetabledata->program_id = $program_id;
        $timetabledata->course_id = $course_id;
        $timetabledata->venue_id = $venue_id;
        $timetabledata->save();

        return redirect()->back()->with('success', 'Successful: Timetable has been created successfully');
    }

    public function addTimetableSlot($id)
    {
        $timetable = Timetable::where('id', '=', $id)->first();

        return view('/office-assistant/timetable/add-timetable-slot/', compact('timetable'));

    }

    public function saveTimetableSlot(Request $request)
    {
        //        Validation
        $request->validate([
            'slots' => 'required|date|date_format:Y-m-d',
        ]);

        $id = $request->id;
        $slots = $request->slots;

//        Create the update query by calling our Course Eloquent Model
        Timetable::where('id', '=', $id)->update([
            'slots' => $slots
        ]);
        return view('/office-assistant/timetable/timetable-list')->with('success', 'Successful: Timetable slots has been added successfully for this entity');
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
//            'holiday_id' => 'required',
            'slots' => 'required|date|date_format:Y-m-d',
        ]);

        $id = $request->id;
        $program_id = $request->program_id;
        $course_id = $request->course_id;
        $venue_id = $request->venue_id;
//        $holiday_id = $request->holiday_id;
        $slots = $request->slots;

//        Create the update query by calling our Course Eloquent Model
        Timetable::where('id', '=', $id)->update([
            'program_id' => $program_id,
            'course_id' => $course_id,
            'venue_id' => $venue_id,
//            'holiday_id' => $holiday_id,
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
