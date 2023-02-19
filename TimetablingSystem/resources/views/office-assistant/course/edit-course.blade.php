<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/app.css">
    <script src="/app.js"></script>
    <link rel="stylesheet" href="/assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <title>Timetabling System</title>
</head>
<body>

<div class="row">
    <div class="column side">
        <img src="/TtS-Logo.png" alt="TtS Logo">
        <p>Timetabling System</p>
        <a href="/office-assistant/overview"> <i class="fa fa-tachometer" aria-hidden="true"></i> Overview</a>
        <a href="/office-assistant/user-application/user-application-list"><i class="fa fa-user-plus"
                                                                              aria-hidden="true"></i>
            User Applications</a>
        <a href="/office-assistant/public-holiday/public-holiday-list"><i class="fa fa-plane" aria-hidden="true"></i>
            Public Holidays</a>
        <a href="/office-assistant/program/program-list"><i class="fa fa-building" aria-hidden="true"></i>
            Programs</a>
        <a href="/office-assistant/venue/venue-list"><i class="fa fa-map-marker" aria-hidden="true"></i>
            Venues</a>
        <a href="/office-assistant/course/course-list"><i class="fa fa-server" aria-hidden="true"></i>
            Courses</a>
        <a href="/office-assistant/timetable/timetable-list">
            <i class="fa fa-calendar" aria-hidden="true"></i>
            Timetable</a>
{{--        <a href="/login">--}}
{{--            <i class="fa fa-sign-out" aria-hidden="true"></i>--}}
{{--            Logout</a>--}}
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <i class="fa fa-sign-out" aria-hidden="true"></i>
            <button type="submit" class="logout-btn">Logout</button>
        </form>


    </div>

    <div class="column right">
        <div class="header">
            <p1>
                Courses
            </p1>
            <p2>Office Assistant
                <i class="fa fa-user-circle fa-3x" aria-hidden="true" style="color:darkslateblue"></i>
            </p2>
        </div>
        <div class="success-message">
            @if(Session::has('success'))
                {{Session::get('success')}}
            @endif
        </div>

        <div class="container-program">
            <p1>Edit Course</p1>
            <a href="/office-assistant/course/course-list">
                <i class="fa fa-arrow-left" aria-hidden="true"> BACK</i>
            </a>
            <div class="container-table-program">
                <form method="post" action="{{url('/office-assistant/course/update-course')}}">
                    {{--                                        in laravel we want to use crf token, this is why we pass it--}}
                    @csrf
                    <input type="hidden" name="id" value="{{$data->id}}">
                    <table>
                        <col class="col-itemname"/>
                        <col class="col-inputbox"/>
                        <tr>
                            <td style="color: #252733">Course Name</td>
                            <td style="color: red"><input type="text" class="create-edit-inputbox"
                                                          placeholder="Course Name" name="course_name"
                                                          value="{{$data->course_name}}">
                                @error('course_name')
                                {{$message}}
                                @enderror</td>
                        </tr>
                        <tr>
                            <td style="color: #252733">Course Code</td>
                            <td style="color: red"><input type="text" class="create-edit-inputbox"
                                                          placeholder="Course Code" name="course_code"
                                                          value="{{$data->course_code}}">
                                @error('course_code')
                                {{$message}}
                                @enderror</td>
                        </tr>
                        <tr>
                            <td style="color: #252733">Course Type</td>
                            <td style="color: red">
                                <select class="create-edit-inputbox"
                                        placeholder="Course Type" name="course_type">
                                    <option value="Core Course">Core Course</option>
                                    <option value="Elective Coursee">Elective Course</option>
                                    <option value="Master's Project">Master's Project</option>
                                    <option value="General University Course">General University Course</option>
                                </select>
                                @error('course_type')
                                {{$message}}
                                @enderror</td>
                        </tr>
                        <tr>
                            <td style="color: #252733">Program</td>
                            <td style="color: red">
                                @php
                                    $programs = \App\Models\Program::all();
                                @endphp
                                <select class="create-edit-inputbox" placeholder="Program" name="program_id">
                                    @foreach($programs as $program)
                                        <option value="{{$program->id}}">{{$program->program_code}} - {{$program->program_name}}</option>
                                    @endforeach
                                </select>
                                @error('program_id')
                                {{$message}}
                                @enderror</td>
                        </tr>
                        <tr>
                            <td style="color: #252733">Section Number</td>
                            <td style="color: red"><input type="text" class="create-edit-inputbox"
                                                          placeholder="Section Number" name="section_number"
                                                          value="{{$data->section_number}}" required>
                                @error('section_number')
                                {{$message}}
                                @enderror</td>
                        </tr>
                        <tr>
                            <td style="color: #252733">Lecturer</td>
                            <td style="color: red">
                                @php
                                    $lecturers = \App\Models\User::all();
                                @endphp
                                <select class="create-edit-inputbox"  placeholder="Lecturer" name="lecturer_id" required>
                                    @foreach($lecturers as $lecturer)
                                        @if($lecturer->lecturer_registration_status == 'approved')
                                            <option value="{{$lecturer->id}}">{{$lecturer->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('lecturer_id')
                                {{$message}}
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td style="color: #252733">Number of Meetings</td>
                            <td style="color: red"><input type="text" class="create-edit-inputbox"
                                                          placeholder="Number of Meetings" name="number_of_meetings"
                                                          value="{{$data->number_of_meetings}}">
                                @error('number_of_meetings')
                                {{$message}}
                                @enderror</td>
                        </tr>
                    </table>

                    <button type="submit" class="create-edit-btn">UPDATE</button>

                </form>
            </div>
        </div>
    </div>
</div>

{{--footer--}}
<div class="footer">Created by SSZ Solutions. © 2023</div>

</body>
</html>
