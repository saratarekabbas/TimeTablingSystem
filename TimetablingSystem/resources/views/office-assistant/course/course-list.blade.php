{{--This Page Contains the list of all Courses--}}

    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/app.css">
    <script src="/app.js"></script>
    <link rel="stylesheet" href="assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <title>Course List</title>
</head>
<body>

<div class="row">
    <div class="column side">
        <img src="/public/TtS-Logo.png" alt="TtS Logo">
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
                <p> List of Courses</p>
            </div>

            <div class="container-heading">
                <a href="{{url('/office-assistant/course/add-course')}}" class="container-action-btns">Add a New
                    Course</a>
            </div>

            @if(Session::has('success'))
                {{--    This should be an alert--}}
                {{Session::get('success')}}
            @endif

            {{--Display as CARDS--}}
            @foreach($data as $coursedata)
                <fieldset>
                    <h2>{{$coursedata->course_code}} - {{$coursedata->course_title}}</h2>

                    <label>Course Code: </label>
                    {{$coursedata->course_code}}

                    <label>Course Title: </label>
                    {{$coursedata->course_title}}

                    <label>Course Type: </label>
                    {{$coursedata->course_type}}

                    <label>Program(s): </label>
                    <ul>
                        @foreach($coursedata->course_program as $program)
                            <li>{{$program}} Package XX<br></li>
                        @endforeach
                    </ul>

                    <label>Section(s): </label>
                    <ul>
                        @foreach($coursedata->course_section as $section)
                            <li>{{$section}} Dr XXX<br></li>
                        @endforeach
                    </ul>

                    <a href="{{url('/office-assistant/course/edit-course/'.$programdata->id)}}"
                       class="edit-btn">Edit</a>
                    <a href="{{url('/office-assistant/course/delete-course/'.$programdata->id)}}"
                       class="delete-btn">Delete</a>

                </fieldset>
            @endforeach


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

