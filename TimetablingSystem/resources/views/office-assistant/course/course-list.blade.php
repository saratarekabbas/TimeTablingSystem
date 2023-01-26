{{--This Page Contains the list of all Programs--}}

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
    <title>Course List</title>
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
        <a href="/login">
            <i class="fa fa-sign-out" aria-hidden="true"></i>
            Logout</a>
    </div>

    <div class="column right">
        <div class="header">
            <p>Office Assistant
                <i class="fa fa-user-circle fa-3x" aria-hidden="true" style="color:darkslateblue"></i>
            </p>
        </div>

        {{--        container for the page content--}}
        <div class="container">
            <div class="container-title">
                <p> List of Courses</p>
            </div>

            <div class="container-heading">


                <div class="dropdown">
                    <button onclick="myFunction()" class="dropbtn"><i class="fa fa-filter fa-2x" aria-hidden="true"></i>
                        Filter by Program
                    </button>
                    <div id="myDropdown" class="dropdown-content">

                        <input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">
                        <a href="{{url('/office-assistant/course/course-list/')}}">All Programs</a>
                        @foreach($programs as $program)
                            <a href="{{url('/office-assistant/course/course-list/'.$program->id)}}">{{$program->program_code}}
                                - {{$program->program_name}}</a>
                        @endforeach
                    </div>
                </div>

                <script>
                    /* When the user clicks on the button,
                    toggle between hiding and showing the dropdown content */
                    function myFunction() {
                        document.getElementById("myDropdown").classList.toggle("show");
                    }

                    function filterFunction() {
                        var input, filter, ul, li, a, i;
                        input = document.getElementById("myInput");
                        filter = input.value.toUpperCase();
                        div = document.getElementById("myDropdown");
                        a = div.getElementsByTagName("a");
                        for (i = 0; i < a.length; i++) {
                            txtValue = a[i].textContent || a[i].innerText;
                            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                a[i].style.display = "";
                            } else {
                                a[i].style.display = "none";
                            }
                        }
                    }
                </script>

                <a href="{{url('/office-assistant/course/add-course')}}" class="container-action-btns">Add a New
                    Course</a>
            </div>

            <div class="success-message">
                @if(Session::has('success'))
                    {{--    This should be an alert--}}
                    {{Session::get('success')}}
                @endif
            </div>

            <div class="container-table">
                <table id="table">
                    <tr>
                        <th>#</th>
                        <th>Course Name</th>
                        <th>Course Code</th>
                        <th>Course Type</th>
                        {{--                        <th>Program</th>--}}
                        <th>Section Number</th>
                        <th>Lecturer</th>
                        <th>Number of Meetings</th>
                        <th>Action</th>
                    </tr>
                    @php
                        $i = 1;
                    @endphp
                    @foreach($data as $coursedata)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$coursedata->course_name}}</td>
                            <td>{{$coursedata->course_code}}</td>
                            <td>{{$coursedata->course_type}}</td>


                            {{--                            @php--}}
                            {{--                                $programs = \App\Models\Program::all();--}}
                            {{--                            @endphp--}}
                            {{--                            @foreach($programs as $program)--}}
                            {{--                                @if($program->id == $coursedata->program_id)--}}
                            {{--                                    <td>{{$program->program_name}}</td>--}}
                            {{--                                @endif--}}
                            {{--                            @endforeach--}}


                            <td>{{$coursedata->section_number}}</td>


                            @php
                                $lecturers = \App\Models\Lecturer::all();
                            @endphp
                            @foreach($lecturers as $lecturer)
                                @if($lecturer->id == $coursedata->lecturer_id)
                                    <td>{{$lecturer->lecturer_name}}</td>
                                @endif
                            @endforeach


                            <td>{{$coursedata->number_of_meetings}}</td>

                            <td>
                                <a href="{{url('/office-assistant/course/edit-course/'.$coursedata->id)}}"
                                   class="edit-btn">Edit</a>
                                <a href="{{url('/office-assistant/course/delete-course/'.$coursedata->id)}}"
                                   class="delete-btn">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

{{--all components are added/replaced/shown here--}}
{{--{{$slot}}--}}

{{--footer--}}
<div class="footer">Created by SSZ Solutions. © 2023</div>

</body>
</html>

