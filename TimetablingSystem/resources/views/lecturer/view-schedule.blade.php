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
    {{--    <link rel="stylesheet" href="assets/font-awesome-4.7.0/css/font-awesome.min.css">--}}
    <title>Timetable Entities</title>
</head>
<body>

<div class="row">
    <div class="column side">
        <img src="/TtS-Logo.png" alt="TtS Logo">
        <p>Timetabling System</p>
        <a href="/lecturer/overview"> <i class="fa fa-tachometer" aria-hidden="true"></i>Overview</a>
        <a href="/lecturer/view-schedule"><i class="fa fa-server" aria-hidden="true"></i>
            Schedule</a>
        {{--        LOGOUT--}}
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
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
                <p> List of Entities</p>
            </div>

            <div class="container-heading">

                <div class="dropdown">
                    <button onclick="myFunction1()" class="dropbtn"><i class="fa fa-filter fa-2x" aria-hidden="true"></i>
                        Filter by Program
                    </button>
                    <div id="myDropdown1" class="dropdown-content">

                        <input type="text" placeholder="Search.." id="myInput1" onkeyup="filterFunction1()">
                        <a href="{{url('/lecturer/timetable/timetable-list/')}}">All Programs</a>
                        @php
                            $programs = \App\Models\Program::all();
                        @endphp
                        @foreach($programs as $program)
                            <a href="{{url('/office-assistant/timetable/timetable-list/'.$program->id)}}">{{$program->program_code}}
                                - {{$program->program_name}}</a>
                        @endforeach
                    </div>
                </div>

                <script>
                    /* When the user clicks on the button,
                    toggle between hiding and showing the dropdown content */
                    function myFunction1() {
                        document.getElementById("myDropdown1").classList.toggle("show");
                    }

                    function filterFunction1() {
                        var input, filter, ul, li, a, i;
                        input = document.getElementById("myInput1");
                        filter = input.value.toUpperCase();
                        div = document.getElementById("myDropdown1");
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





              <a href="{{url('/lecturer/timetable/print-schedule/export')}}" class="container-action-btns">  <i class="fa fa-print fa-2x" aria-hidden="true"></i> Print Schedule</a>

                <br><br><br>
                <a href="{{url('/lecturer/timetable/calendar-view/view-calendar')}}"
                   class="container-action-btns">View Calendar</a>
                <br><br><br>
            </div>
            @if(Session::has('success'))
                This should be an alert
                {{Session::get('success')}}
            @endif

            <div class="container-table">
                <table id="table">
                    <tr>
                        <th>#</th>
                        <th>Program</th>
                        <th>Course</th>
                        <th>Venue</th>
                        <th>Meetings</th>
                        <th>Remarks</th>
                        <th>Action</th>
                    </tr>
                    @php
                        $i = 1;
                    @endphp

                    @foreach($timetable as $timetabledata)
                        <tr>
                            <td>{{$i++}}</td>
                            @php
                                $programs = \App\Models\Program::all();
                            @endphp
                            @foreach($programs as $program)
                                @if($program->id == $timetabledata->program_id)
                                    <td>{{$program->program_code}} - {{$program->program_name}}</td>
                                @endif
                            @endforeach

                            @php
                                $courses = \App\Models\Course::all();
                            @endphp
                            @foreach($courses as $course)
                                @if($course->id == $timetabledata->course_id)
                                    <td>{{$course->course_code}} - {{$course->course_name}}</td>
                                @endif
                            @endforeach

                            @php
                                $venues = \App\Models\Venue::all();
                            @endphp
                            @foreach($venues as $venue)
                                @if($venue->id == $timetabledata->venue_id)
                                    <td>{{$venue->venue_name}}, {{$venue->venue_level}}, {{$venue->venue_location}}</td>
                                @endif
                            @endforeach
                            <td>

                                @if($timetabledata->slots == NULL)
                                    No Assigned Slots.
                                @else
                                    <ol>
                                        @php
                                            $meeting_number = 1;
                                        @endphp
                                        @foreach($timetabledata->slots as $slot)
                                            <li>Meeting {{$meeting_number++}}: {{$slot}}</li>
                                        @endforeach
                                    </ol>
                                @endif
                            </td>
                            <td>
                                @if($timetabledata->remarks == NULL)
                                    No Remarks
                                @else
                                {{$timetable->remarks}}
                                @endif
                            </td>
                            <td>
                                @if($timetabledata->slots == NULL)
                                    <b> No Slots have been added yet </b>
                                @else
                                    <a href="{{url('/lecturer/timetable/edit-timetable-slot/'.$timetabledata->id)}}"
                                       class="edit-btn">Edit Slots</a>
                                @endif
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

