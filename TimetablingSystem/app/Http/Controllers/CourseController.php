<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Program;
use App\Models\Timetable;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $data = Course::get();
        $programs = Program::all();
        //compact is to pass $data basically
        return view('/office-assistant/course/course-list', compact('data', 'programs'));
    }

    public function filterProgram($id)
    {
        $findProgram = Program::where('id', $id)->first();
        $data = Course::where('program_id', $findProgram->id)->get();
        $programs = Program::all();
        //compact is to pass $data basically
        return view('/office-assistant/course/course-list', compact('data', 'programs'));
    }


    public function addCourse()
    {
        return view('/office-assistant/course/add-course');
    }

    public function saveCourse(Request $request)
    {
//        Validation
        $request->validate([
            'course_name' => 'required|unique:courses,course_name',
            'course_code' => 'required|string|min:8|max:8|unique:courses,course_code',
            'course_type' => 'required',
            'program_id' => 'required',
            'section_number' => 'required|integer|max:100|min:1',
            'lecturer_id' => 'required',
            'number_of_meetings' => 'required|integer|max:6|min:1',
        ]);

        $course_name = $request->course_name;
        $course_code = $request->course_code;
        $course_type = $request->course_type;
        $program_id = $request->program_id;
        $section_number = $request->section_number;
        $lecturer_id = $request->lecturer_id;
        $number_of_meetings = $request->number_of_meetings;

//        Create a model in our Eloquent Model Program
        $coursedata = new Course();
        $coursedata->course_name = $course_name;
        $coursedata->course_code = $course_code;
        $coursedata->course_type = $course_type;
        $coursedata->program_id = $program_id;
        $coursedata->section_number = $section_number;
        $coursedata->lecturer_id = $lecturer_id;
        $coursedata->number_of_meetings = $number_of_meetings;
        $coursedata->save();

        return redirect()->back()->with('success', 'Successful: Course has been created successfully');
    }

    public function editCourse($id)
    {
        $data = Course::where('id', '=', $id)->first();
        return view('/office-assistant/course/edit-course', compact('data'));
    }

    public function updateCourse(Request $request)
    {
        //        Validation
        $request->validate([
            'course_name' => 'required|unique:courses,course_name',
            'course_code' => 'required|string|min:8|max:8|unique:courses,course_code',
            'course_type' => 'required',
            'program_id' => 'required',
            'section_number' => 'required|integer|max:100|min:1',
            'lecturer_id' => 'required',
            'number_of_meetings' => 'required|integer|max:6|min:1',
        ]);

        $id = $request->id;
        $course_name = $request->course_name;
        $course_code = $request->course_code;
        $course_type = $request->course_type;
        $program_id = $request->program_id;
        $section_number = $request->section_number;
        $lecturer_id = $request->lecturer_id;
        $number_of_meetings = $request->number_of_meetings;

//        Create the update query by calling our Course Eloquent Model
        Course::where('id', '=', $id)->update([
            'course_name' => $course_name,
            'course_code' => $course_code,
            'course_type' => $course_type,
            'program_id' => $program_id,
            'section_number' => $section_number,
            'lecturer_id' => $lecturer_id,
            'number_of_meetings' => $number_of_meetings
        ]);

        return redirect()->back()->with('success', 'Successful: Course has been updated successfully');
    }

    public function deleteCourse($id)
    {
        $timetables = Timetable::all();
        foreach ($timetables as $timetable) {
            if ($id == $timetable->course_id) {
                Timetable::where('course_id', '=', $id)->delete();
            }
        }
        Course::where('id', '=', $id)->delete();
        return redirect()->back()->with('success', 'Successful: Course has been deleted successfully');
    }
}
