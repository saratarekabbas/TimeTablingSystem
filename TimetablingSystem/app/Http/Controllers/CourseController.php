<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    { //fetch all records and display lists
        $data = Course::get();
        //compact is to pass $data basically
        return view('/office-assistant/course/course-list', compact('data'));
    }

    public function addCourse()
    {
        return view('/office-assistant/course/add-course');
    }

    public function saveCourse(Request $request)
    {
//        Validation
        $request->validate([
            'course_title' => 'required|unique:course,course_title',
            'course_code' => 'required|string|min:8|max:8|unique:course,course_code',
            'program' => 'required|exists:programs,id', //id must exist in table programs
            'program_package' => 'required',
            'course_type' => 'required',
            'course_section' => 'required|integer',
            'course_lecturer' => 'required|exists:lecturers,id', //id must exist in table lecturers
        ]);

        $course_title = $request->course_title;
        $course_code = $request->course_code;
        $program = $request->program;
        $program_package = $request->program_package;
        $course_type = $request->course_type;
        $course_section = $request->course_section;
        $course_lecturer = $request->course_lecturer;

//        Create a model in our Eloquent Model Course
        $coursedata = new Course();
        $coursedata->course_title = $course_title;
        $coursedata->course_code = $course_code;
        $coursedata->program = $program;
        $coursedata->program_package = $program_package;
        $coursedata->course_type = $course_type;
        $coursedata->course_section = $course_section;
        $coursedata->course_lecturer = $course_lecturer;
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
            'course_title' => 'required|unique:course,course_title',
            'course_code' => 'required|string|min:8|max:8|unique:course,course_code',
            'program' => 'required',
//            'program_package' => 'required',
            'course_type' => 'required',
            'course_section' => 'required|integer',
            'course_lecturer' => 'required|exists:lecturers,id', //id must exist in table lecturers
        ]);

        $id = $request->id;
        $course_title = $request->course_title;
        $course_code = $request->course_code;
        $program = $request->program;
//        $program_package = $request->program_package;
        $course_type = $request->course_type;
        $course_section = $request->course_section;
        $course_lecturer = $request->course_lecturer;

//        Create the update query by calling our Course Eloquent Model
        Course::where('id', '=', $id)->update([
            'course_title' => $course_title,
            'course_code' => $course_code,
            'program' => $program,
//            'program_package' => $program_package,
            'course_type' => $course_type,
            'course_section' => $course_section,
            'course_lecturer' => $course_lecturer
        ]);

        return redirect()->back()->with('success', 'Successful: Course has been updated successfully');
    }

    public function deleteCourse($id)
    {
        Course::where('id', '=', $id)->delete();
        return redirect()->back()->with('success', 'Successful: Course has been deleted successfully');
    }
}
