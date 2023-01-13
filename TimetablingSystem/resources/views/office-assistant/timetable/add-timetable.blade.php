<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Program</title>
</head>
<body>
<h1>Add a New Course</h1>

{{--This means, display success messge if an item is added successfullyS--}}
@if(Session::has('success'))
    {{--    This should be an alert--}}
    {{Session::get('success')}}
@endif

<form method="post" action="{{url('/office-assistant/course/save-course')}}">
    {{--    in laravel we want to use crf token, this is why we pass it--}}
    @csrf
    <label>Course Name: </label>
    <input type="text" name="course_name" placeholder="Course Name..."
           value="{{old('course_name')}}">
    @error('course_name')
    {{$message}}
    @enderror
    <br>

    <label>Course Code: </label>
    <input type="text" name="course_code" placeholder="Course Code..."
           value="{{old('course_code')}}">
    @error('course_code')
    {{$message}}
    @enderror
    <br>

    <label>Course Type: </label>
    <select name="course_type">
        <option value="Core Course">Core Course</option>
        <option value="Elective Coursee">Elective Course</option>
        <option value="Master's Project">Master's Project</option>
        <option value="General University Course">General University Course</option>
    </select>
    @error('course_type')
    {{$message}}
    @enderror
    <br>

    <label>Program: </label>
    @php
        $programs = \App\Models\Program::all();
    @endphp
    <select name="program_id">
        @foreach($programs as $program)
            <option value="{{$program->id}}">{{$program->program_code}} - {{$program->program_name}}</option>
        @endforeach
    </select>
    @error('program_id')
    {{$message}}
    @enderror

    <br>

    <label>Section Number: </label>
    <input type="text" name="section_number" placeholder="Section Number..."
           value="{{old('section_number')}}">
    @error('section_number')
    {{$message}}
    @enderror
    <br>

    <label>Lecturer: </label>
    @php
   $lecturers = \App\Models\Lecturer::all();
    @endphp
    <select name="lecturer_id">
        @foreach($lecturers as $lecturer)
            @if($lecturer->lecturer_registration_status == 'approved')
            <option value="{{$lecturer->id}}">{{$lecturer->lecturer_name}}</option>
            @endif
        @endforeach
    </select>
    @error('lecturer_id')
    {{$message}}
    @enderror

    <br>
    <label>Number of Meetings: </label>
    <input type="text" name="number_of_meetings" placeholder="Number of Meetings..."
           value="{{old('number_of_meetings')}}">
    @error('number_of_meetings')
    {{$message}}
    @enderror
    <br>

    <button type="submit">CREATE</button>

    <a href="{{url('/office-assistant/course/course-list')}}">Back</a>
</form>
</body>
</html>
