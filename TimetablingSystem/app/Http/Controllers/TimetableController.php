<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\Program;
use App\Models\PublicHoliday;
use App\Models\Timetable;
use App\Models\Venue;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use League\CommonMark\Node\Inline\Newline;


class TimetableController extends Controller
{
    public function index()
    { //fetch all records and display lists
        $timetable = Timetable::get();
        //compact is to pass $data basically
        return view('/office-assistant/timetable/timetable-list', compact('timetable'));
    }


//  LECTURER
    public function lecturerIndex()
    {
        $user = Auth::user();

        $userId = ($user instanceof User) ? $user->id : null;

        $courses = Course::where('lecturer_id', $userId)->get();
        $courseIds = $courses->pluck('id')->toArray();

        $timetable = Timetable::whereIn('course_id', $courseIds)->get();

        return view('/lecturer/view-schedule', compact('timetable'));
    }

    public function editScheduleSlot($id)
    {
        $timetable = Timetable::where('id', '=', $id)->first();
        $meetings_number = Course::where('id', '=', $timetable->course_id)->first()->number_of_meetings;

        return view('/lecturer/edit-schedule-slot', compact('timetable', 'meetings_number'));
    }

    public function updateScheduleSlot(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'slots.*' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    $currentIndex = array_search($value, $request->slots);
                    if ($currentIndex > 0 && $value <= $request->slots[$currentIndex - 1]) {
                        return $fail("Meeting " . ($currentIndex + 1) . " must be after meeting " . $currentIndex);
                    }

                    $publicHolidays = PublicHoliday::all();
                    $meetingDate = Carbon::parse($value);

                    foreach ($publicHolidays as $publicHoliday) {
                        $publicHolidayStart = Carbon::parse($publicHoliday->public_holiday_start_date);
                        $publicHolidayEnd = Carbon::parse($publicHoliday->public_holiday_end_date);

                        if ($meetingDate->between($publicHolidayStart, $publicHolidayEnd)) {
                            $fail("Sorry, you cannot have a meeting on {$value} because it is a public holiday.");
                        }
                    }

//                    Venue Validations

                    $timetable = Timetable::find($request->id);
                    $venue_id = $timetable->venue_id;

                    $timetables = Timetable::where('venue_id', $venue_id)->get();

                    foreach ($timetables as $timetable) {
                        if (is_array($timetable->slots) && in_array($value, $timetable->slots)) {
                            $fail("Sorry, the venue is occupied on {$value}");
                        }
                    }

//                  Lecturer Validations
                    $timetable = Timetable::find($request->id);
                    $course = Course::find($timetable->course_id);
                    $lecturer_id = $course->lecturer_id;

                    $otherTimetables = Timetable::where('course_id', '!=', $timetable->course_id)
                        ->whereHas('course', function ($query) use ($lecturer_id) {
                            $query->where('lecturer_id', $lecturer_id);
                        })->get();

                    foreach ($otherTimetables as $otherTimetable) {
                        if (is_array($otherTimetable->slots) && in_array($value, $otherTimetable->slots)) {
                            $fail("Sorry, you have another lecture on {$value}");
                        }
                    }
                }
            ]]);

        $id = $request->id;
        $slots = $request->slots;
//        $remarks = $request->remarks;

//        Create the update query by calling our Course Eloquent Model
        Timetable::where('id', '=', $id)->update([
            'slots' => $slots,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        return redirect()->back()->with('success', 'Successful: Schedule slots have been updated successfully');
    }


    public function lecturerCalendarIndex()
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
            $course_lecturer = User::where('id', '=', Course::where('id', '=', $timetable->course_id)->first()->lecturer_id)->first()->lecturer_name;
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
        return view('/lecturer/lecturer-view-calendar', ['meetings' => $meetings]);
    }

    public function lecturerFilterCalendar($id)
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
        $findProgram = Program::where('id', $id)->first();
        $timetables = Timetable::where('program_id', $findProgram->id)->get();
        $slots[] = array();
        foreach ($timetables as $timetable) {
            $course_code = Course::where('id', '=', $timetable->course_id)->first()->course_code;
            $course_title = Course::where('id', '=', $timetable->course_id)->first()->course_name;
            $course_lecturer = User::where('id', '=', Course::where('id', '=', $timetable->course_id)->first()->lecturer_id)->first()->lecturer_name;
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
        return view('/lecturer/lecturer-view-calendar/', ['meetings' => $meetings]);
    }


    public function lecturerExportAll()
    {
        $timetable = Timetable::get();
        $pdf = Pdf::LoadView('/office-assistant/timetable/print-timetable', compact('timetable'));
        return $pdf->download('timetable.pdf');
    }

    public function lecturerExport($id)
    {
        $findProgram = Program::where('id', $id)->first();
        $timetable = Timetable::where('program_id', $findProgram->id)->get();
        $pdf = Pdf::LoadView('/office-assistant/timetable/print-timetable', compact('timetable'));
        return $pdf->download('timetable.pdf');
    }

////////////////////////////////////////////////
///     Office Assistant
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
        return view('/office-assistant/timetable/add-timetable', compact('courses'));
    }

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
        $validator = Validator::make($request->all(), [
            'slots.*' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    $currentIndex = array_search($value, $request->slots);
                    if ($currentIndex > 0 && $value <= $request->slots[$currentIndex - 1]) {
                        return $fail("Meeting " . ($currentIndex + 1) . " must be after meeting " . $currentIndex);
                    }

                    $publicHolidays = PublicHoliday::all();
                    $meetingDate = Carbon::parse($value);

                    foreach ($publicHolidays as $publicHoliday) {
                        $publicHolidayStart = Carbon::parse($publicHoliday->public_holiday_start_date);
                        $publicHolidayEnd = Carbon::parse($publicHoliday->public_holiday_end_date);

                        if ($meetingDate->between($publicHolidayStart, $publicHolidayEnd)) {
                            $fail("Sorry, you cannot have a meeting on {$value} because it is a public holiday.");
                        }
                    }

//                    Venue Validations

                    $timetable = Timetable::find($request->id);
                    $venue_id = $timetable->venue_id;

                    $timetables = Timetable::where('venue_id', $venue_id)->get();

                    foreach ($timetables as $timetable) {
                        if (is_array($timetable->slots) && in_array($value, $timetable->slots)) {
                            $fail("Sorry, the venue is occupied on {$value}");
                        }
                    }

//                  Lecturer Validations
                    $timetable = Timetable::find($request->id);
                    $course = Course::find($timetable->course_id);
                    $lecturer_id = $course->lecturer_id;

                    $otherTimetables = Timetable::where('course_id', '!=', $timetable->course_id)
                        ->whereHas('course', function ($query) use ($lecturer_id) {
                            $query->where('lecturer_id', $lecturer_id);
                        })->get();

                    foreach ($otherTimetables as $otherTimetable) {
                        if (is_array($otherTimetable->slots) && in_array($value, $otherTimetable->slots)) {
                            $fail("Sorry, the lecturer has another class on {$value}");
                        }
                    }
                }
            ]
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $id = $request->id;
        $slots = $request->slots;

        Timetable::where('id', '=', $id)->update([
            'slots' => $slots
        ]);

        return redirect()->back()->with('success', 'Successful: Timetable slot has been created successfully');
    }

    public function editTimetable($id)
    {
        $timetable = Timetable::where('id', '=', $id)->first();
        $course = Course::where('id', '=', $timetable->course_id)->first();
        return view('/office-assistant/timetable/edit-timetable', compact('timetable', 'course'));
    }

    public function updateTimetable(Request $request)
    {
        //        Validation
        $request->validate([
            'venue_id' => 'required',
        ]);

        $id = $request->id;
        $venue_id = $request->venue_id;

//        Create the update query by calling our Course Eloquent Model
        Timetable::where('id', '=', $id)->update([

            'venue_id' => $venue_id,
        ]);

        return redirect()->back()->with('success', 'Successful: Timetable entity has been updated successfully');
    }

    public function editTimetableSlot($id)
    {
        $timetable = Timetable::where('id', '=', $id)->first();
        $meetings_number = Course::where('id', '=', $timetable->course_id)->first()->number_of_meetings;

        return view('/office-assistant/timetable/edit-timetable-slot', compact('timetable', 'meetings_number'));
    }

    public function updateTimetableSlot(Request $request)
    {
        //        Validation
        $request->validate([
            'slots' => 'required',
        ]);

        $id = $request->id;
        $slots = $request->slots;

//        Create the update query by calling our Course Eloquent Model
        Timetable::where('id', '=', $id)->update([
            'slots' => $slots,
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
            $course_lecturer = User::where('id', '=', Course::where('id', '=', $timetable->course_id)->first()->lecturer_id)->first()->lecturer_name;
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

    public function filterCalendar($id)
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
        $findProgram = Program::where('id', $id)->first();
        $timetables = Timetable::where('program_id', $findProgram->id)->get();
        $slots[] = array();
        foreach ($timetables as $timetable) {
            $course_code = Course::where('id', '=', $timetable->course_id)->first()->course_code;
            $course_title = Course::where('id', '=', $timetable->course_id)->first()->course_name;
            $course_lecturer = User::where('id', '=', Course::where('id', '=', $timetable->course_id)->first()->lecturer_id)->first()->lecturer_name;
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


    public function exportAll()
    {
        $timetable = Timetable::get();
        $pdf = Pdf::LoadView('/office-assistant/timetable/print-timetable', compact('timetable'));
        return $pdf->download('timetable.pdf');
    }

    public function export($id)
    {
        $findProgram = Program::where('id', $id)->first();
        $timetable = Timetable::where('program_id', $findProgram->id)->get();
        $pdf = Pdf::LoadView('/office-assistant/timetable/print-timetable', compact('timetable'));
        return $pdf->download('timetable.pdf');
    }

}
