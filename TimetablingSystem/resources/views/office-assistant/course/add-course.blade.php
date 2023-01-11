<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Course</title>
</head>
<body>
<h1>Add a New Course</h1>

{{--This means, display success messge if an item is added successfullyS--}}
@if(Session::has('success'))
    {{--    This should be an alert--}}
    {{Session::get('success')}}
@endif

<form method="post" action="{{url('/office-assistant/course/save-course')}}">
    @csrf
    <label>Course Title: </label>
    <input type="text" name="course_title" placeholder="Course Title..."
           value="{{old('course_title')}}">
    @error('course_title')
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

    <label>Program: </label>
    @php
        $programs = \App\Models\Program::all();
    @endphp
    <select name="program">
        @foreach($programs as $program)
            <option value="{{$program->id}}">{{$program->program_code}} - {{$program->program_name}}</option>
        @endforeach
    </select>
    @error('program')
    {{$message}}
    @enderror
    <br>

{{--    <label>Program Packages: </label>--}}
{{--    @php--}}
{{--        $programs = \App\Models\Program::all();--}}
{{--    @endphp--}}
{{--    <select name="program">--}}
{{--        @foreach($programs as $program)--}}
{{--            <option value="{{$program->id}}">{{$program->program_code}} - {{$program->program_name}}</option>--}}
{{--        @endforeach--}}
{{--    </select>--}}
{{--    @error('program')--}}
{{--    {{$message}}--}}
{{--    @enderror--}}
{{--    <br>--}}

    {{--    <input type="checkbox" name="program_package[]" value="Package 1">Package 1<br/>--}}
    {{--    <input type="checkbox" name="program_package[]" value="Package 2">Package 2<br/>--}}
    @error('program_package')
    {{$message}}
    @enderror

    <br>

    <label>Course Type: </label>

    <select name="course_type">
        <option value="Core Course">Core Course</option>
        <option value="Master's Project">Master's Project</option>
        <option value="General University Course">General University Course</option>
        <option value="Elective Course">Elective Course</option>
    </select>
    @error('course_type')
    {{$message}}
    @enderror
    <br>

    {{--    code the logic later--}}
    <label>Course Section: </label>
    <select name="course_section">
        <option value="Package 1">Package 1</option>
        <option value="Package 2">Package 2</option>
    </select>
    @error('program_code')
    {{$message}}
    @enderror
    <br>


    <label>Lecturer Name: </label>
    @php
        $lecturers = \App\Models\Lecturer::all();
    @endphp
    <select name="course_lecturer">
        @foreach($lecturers as $lecturer)
            <option value="{{$lecturer->id}}">{{$lecturer->lecturer_name}}</option>
        @endforeach
    </select>
    @error('lecturer_name')
    {{$message}}
    @enderror
    <br>

    <button type="submit">CREATE</button>

    <a href="{{url('/office-assistant/course/course-list')}}">Back</a>
</form>
</body>
</html>
