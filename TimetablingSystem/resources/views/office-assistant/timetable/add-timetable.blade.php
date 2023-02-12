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
    <title>Add Timetable</title>
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
            <p1>
                Timetable
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

        {{--        container for the page content--}}
        <div class="container-program">
            <p1>Add a New Timetable Entity</p1>
            <a href="/office-assistant/timetable/timetable-list/">
                <i class="fa fa-arrow-left" aria-hidden="true"> BACK</i>
            </a>
            <div class="container-table-program">
                <form method="post" action="{{url('/office-assistant/timetable/save-timetable')}}">
                    {{--                    in laravel we want to use crf token, this is why we pass it--}}
                    @csrf
                    <table>
                        <col class="col-itemname"/>
                        <col class="col-inputbox"/>
                        <tr>
                            <td style="color: #252733">Course</td>
                            <td style="color: red">
                                <select class="create-edit-inputbox" name="course_id">
                                    <option value="" disabled selected>Course</option>
                                    @foreach($courses as $course)
                                        <option value="{{$course->id}}"> {{$course->course_code}} - {{$course->course_name}}</option>
                                    @endforeach
                                </select>
                                @error('course_id')
                                {{$message}}
                                @enderror</td>
                        </tr>



                        <tr>
                            <td style="color: #252733">Venue</td>
                            @php
                                $venues = \App\Models\Venue::all();
                            @endphp
                            <td style="color: red">
                                <select class="create-edit-inputbox"  name="venue_id">
                                    <option value="" disabled selected>Venue</option>
                                    @foreach($venues as $venue)
                                        <option value="{{$venue->id}}">{{$venue->venue_name}}, Level {{$venue->venue_level}}, {{$venue->venue_location}}
                                            ({{$venue->venue_capacity}} pax)
                                        </option>
                                    @endforeach
                                </select>
                                @error('venue_id')
                                {{$message}}
                                @enderror
                              </td>
                        </tr>
                    </table>
                    {{--                <input class="container-create" value="CREATE">--}}
                    <button type="submit" class="create-edit-btn">PROCEED TO ADD TIMETABLE SLOTS</button>

                </form>
            </div>
        </div>
    </div>
</div>

{{--all components are added/replaced/shown here--}}
{{--{{$slot}}--}}

{{--footer--}}
<div class="footer">Created by SSZ Solutions. © 2023</div>

</body>




{{--<body>--}}
{{--<h1>Add a New Timetable Entity</h1>--}}

{{--This means, display success messge if an item is added successfullyS--}}
{{--@if(Session::has('success'))--}}
{{--    --}}{{--    This should be an alert--}}
{{--    {{Session::get('success')}}--}}
{{--@endif--}}

{{--<form method="post" action="{{url('/office-assistant/timetable/save-timetable')}}">--}}
{{--    @csrf--}}

{{--    <label>Course: </label>--}}
{{--    <select name="course_id">--}}
{{--        @foreach($courses as $course)--}}
{{--            <option value="{{$course->id}}"> {{$course->course_code}} - {{$course->course_name}}</option>--}}
{{--        @endforeach--}}
{{--    </select>--}}
{{--    @error('course_id')--}}
{{--    {{$message}}--}}
{{--    @enderror--}}

{{--    <br>--}}

{{--    <label>Venue: </label>--}}
{{--    @php--}}
{{--        $venues = \App\Models\Venue::all();--}}
{{--    @endphp--}}
{{--    <select name="venue_id">--}}
{{--        @foreach($venues as $venue)--}}
{{--            <option value="{{$venue->id}}">{{$venue->venue_name}}, {{$venue->venue_level}}, {{$venue->venue_location}}--}}
{{--                ({{$venue->venue_capacity}} pax)--}}
{{--            </option>--}}
{{--        @endforeach--}}
{{--    </select>--}}
{{--    @error('venue_id')--}}
{{--    {{$message}}--}}
{{--    @enderror--}}
{{--    <br>--}}

{{--    <button type="submit">PROCEED TO ADD TIMETABLE SLOTS</button>--}}
{{--    <a href="{{url('/office-assistant/timetable/timetable-list')}}">Back</a>--}}
{{--</form>--}}
{{--</body>--}}
{{--</html>--}}
