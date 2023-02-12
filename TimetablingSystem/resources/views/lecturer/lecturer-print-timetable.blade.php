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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    {{--    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}

    <title>Timetable Entities</title>
</head>
<body>

<h1 style="text-align:center;">Schedule</h1>
<br>
<h3>Lecturer: {{$user->name}}</h3>
<br>


<table class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>Program</th>
        <th>Course</th>
        <th>Venue</th>
        <th>Meetings</th>
    </tr>
    </thead>
    <tbody>
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
        </tr>
    @endforeach
    </tbody>
</table>

{{--footer--}}
<div class="footer">Created by SSZ Solutions. © 2023</div>

</body>
</html>
