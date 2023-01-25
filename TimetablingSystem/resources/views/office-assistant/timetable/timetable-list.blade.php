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
    {{--    <link rel="stylesheet" href="assets/font-awesome-4.7.0/css/font-awesome.min.css">--}}
    <title>Timetable Entities</title>
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
    </div>

    <div class="column right">
        <div class="header">
            <p>Office Admin
                <i class="fa fa-sign-out" aria-hidden="true"></i>
            </p>
        </div>

        {{--        container for the page content--}}
        <div class="container">
            <div class="container-title">
                <p> List of Entities</p>
            </div>

            <h5>FILTER BY PROGRAM</h5>
            @php
                $programs = \App\Models\Program::all();
            @endphp
            @foreach($programs as $program)
                <a href="{{url('/office-assistant/timetable/timetable-list/'.$program->id)}}">{{$program->program_code}}
                    - {{$program->program_name}}</a>
            @endforeach


            <div class="container-heading">
                <a href="{{url('/office-assistant/timetable/add-timetable')}}" class="container-action-btns">Add a New
                    Timetable Entity</a>
                <br><br><br>
                <a href="{{url('/office-assistant/timetable/calendar-view/view-calendar')}}"
                   class="container-action-btns">View Timetable</a>
                <br><br><br>

                {{--                PRINTS--}}
                {{--            PRINT ALL TIMETABLE ENTITIES    --}}


                <a href="{{url('/office-assistant/timetable/print-timetable/export/')}}"
                   class="container-action-btns">Print All</a>

                <br> <br> <br>
                @php
                    $programs = \App\Models\Program::all();
                @endphp
                @foreach($programs as $program)
                    <a href="{{url('/office-assistant/timetable/print-timetable/export/'.$program->id)}}"
                       class="container-action-btns">Print {{$program->program_code}}
                        - {{$program->program_name}} </a>

                    <br><br><br>
                @endforeach
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
                                <a href="{{url('/office-assistant/timetable/edit-timetable/'.$timetabledata->id)}}"
                                   class="edit-btn">Edit</a>
                                <a href="{{url('/office-assistant/timetable/delete-timetable/'.$timetabledata->id)}}"
                                   class="delete-btn">Delete</a>


                                @if($timetabledata->slots == NULL)
                                    <a href="{{url('/office-assistant/timetable/add-timetable-slot/'.$timetabledata->id)}}"
                                       class="delete-btn">Add Slots</a>
                                @else
                                    <a href="{{url('/office-assistant/timetable/edit-timetable-slots/'.$timetabledata->id)}}"
                                       class="delete-btn">Edit Slots</a>
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

