<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lecturer;
use App\Models\Program;
use App\Models\PublicHoliday;
use App\Models\Timetable;
use App\Models\Venue;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use League\CommonMark\Node\Inline\Newline;


class TimetableController extends Controller
{
    public function index()
    { //fetch all records and display lists
        $timetable = Timetable::get();
        //compact is to pass $data basically
        return view('/office-assistant/timetable/timetable-list', compact('timetable'));
    }

    public function filterProgram($id)
    {
        $findProgram = Program::where('id', $id)->first();
        $timetable = Timetable::where('program_id', $findProgram->id)->get();
        $programs = Program::all();
        return view('/office-assistant/timetable/timetable-list', compact('timetable', 'programs'));
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
            'course_id' => 'required|unique:timetables,course_id',
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
        $meetings_number = Course::where('id', '=', $timetable->course_id)->first()->number_of_meetings;

        return view('/office-assistant/timetable/add-timetable-slot', compact('timetable', 'meetings_number'));
    }

    public function saveTimetableSlot(Request $request)
    {
        //        Validation
        $request->validate([
            'slots' => 'required',
        ]);

        $id = $request->id;
        $slots = $request->slots;

//        Create the update query by calling our Course Eloquent Model
        Timetable::where('id', '=', $id)->update([
            'slots' => $slots
        ]);
        return redirect()->back()->with('success', 'Successful: Timetable slot has been created successfully');
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

    //-------------------------------------------------------------
    //    Calendar
    //-------------------------------------------------------------

    public function calendarIndex()
    {
        $meetings = array();

//        Public Holiday calendar Display
        $publicHolidays = PublicHoliday::all();
        foreach ($publicHolidays as $publicHoliday) {
            $meetings[] = [
                'title' => $publicHoliday->public_holiday_title,
                'start' => $publicHoliday->public_holiday_start_date . ' 00:00:00',
                'end' => $publicHoliday->public_holiday_end_date . ' 23:59:59',
            ];
        }

//        Timetable calendar display
        $timetables = Timetable::all();
        $slots[] = array();
        foreach ($timetables as $timetable) {
            $course_code = Course::where('id', '=', $timetable->course_id)->first()->course_code;
            $course_title = Course::where('id', '=', $timetable->course_id)->first()->course_name;
            $course_lecturer = Lecturer::where('id', '=', Course::where('id', '=', $timetable->course_id)->first()->lecturer_id)->first()->lecturer_name;
            $course_venue = Venue::where('id', '=', $timetable->venue_id)->first();

            $slots = Timetable::where('id', '=', $timetable->id)->first()->slots;

            if ($slots != NULL) {
                for ($i = 0; $i < sizeof($slots); $i++) {
                    $meetings[] = [
                        'title' => $course_code . ' - ' . $course_title . ' ' . nl2br($course_lecturer) . ' @' . nl2br($course_venue->venue_name . ', Level ' . $course_venue->venue_level . ', ' . $course_venue->venue_location),
                        'start' => $slots[$i] . ' 09:00:00',
                        'end' => $slots[$i] . ' 17:00:00',
                        'color' => '#E59308'
                    ];
                }
            }
            unset($slot);
        }
        return view('/office-assistant/timetable/calendar-view/view-calendar', ['meetings' => $meetings]);
    }

//    Export Function for timetable (office assistant view)
    public function export()
    {
        $timetable = Timetable::get();
        $pdf = Pdf::LoadView('/office-assistant/timetable/print-timetable', compact('timetable'));
        return $pdf->download('timetable.pdf');
    }

}
