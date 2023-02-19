@php
    use Illuminate\Support\Facades\Auth;
    use App\Models\User;
use App\Models\Course;
use App\Models\Timetable;
use App\Models\Venue;

@endphp


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
        <a href="/lecturer/overview"> <i class="fa fa-tachometer" aria-hidden="true"></i>Overview</a>
        <a href="/lecturer/view-schedule"><i class="fa fa-server" aria-hidden="true"></i>
            Schedule</a>
        {{--        LOGOUT--}}
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <i class="fa fa-sign-out" aria-hidden="true"></i>
            <button type="submit" class="logout-btn">Logout</button>
        </form>

    </div>

    <div class="column right">
        <div class="header">
            <p1>
                Overview
            </p1>
            <p>
                @php
                    $user = Auth::user();
                    $userName = ($user instanceof User) ? $user->name : "Lecturer";
                @endphp
                {{$userName}}
{{--                <i class="fa fa-sign-out" aria-hidden="true"></i>--}}
                <i class="fa fa-user-circle fa-3x" aria-hidden="true" style="color:darkslateblue"></i>
            </p>
        </div>
                <div class="container-bulletin">
                    <div class="container-comingclass">
                        <p3> Upcoming Class</p3>
                        <p4>
                            @php
                                $user = \Auth::user();
                                $userId = ($user instanceof User) ? $user->id : NULL;
                                $courses = \App\Models\Course::where('lecturer_id', $userId)->get();
                                $courseIds = $courses->pluck('id')->toArray(); // Course IDs affiliated to this lecturer
                                $timetables = \App\Models\Timetable::whereIn('course_id', $courseIds)->get();
                                $nextClass = null;
                                $currentDate = date('Y-m-d');
                                foreach ($timetables as $timetable) {
                                  $slots = $timetable->slots;
                                  foreach ($slots as $slot) {
                                    if ($slot >= $currentDate) {
                                      $nextClass = $slot;
                                      break 2;
                                    }
                                  }
                                }
                                if ($nextClass) {
                                  echo $nextClass . " 9:00am <br>";
                                  $course = \App\Models\Course::find($timetable->course_id);
                                  echo $course->course_code . " (" . $course->section_number . ")";
                                } else {
                                  echo "No upcoming class";
                                }
                            @endphp
                        </p4>
                    </div>
                    <div class="container-comingclassvenue">
                        <p3> Upcoming Class Venue</p3>
                        <p4>
                            @php
                                if($nextClass){
                                $venue = \App\Models\Venue::find($timetable->venue_id);
                                echo $venue->venue_name . ", Level " . $venue->venue_level . ", " . $venue->venue_location . "<br>(" . $venue->venue_capacity . "pax)";
                                }
                               else{
                                echo "No upcoming venue";
                                }
                            @endphp
                        </p4>
                    </div>
                </div>


        <div class="container-announcement">
             <div class="container-announcement-viewtimetableentity">
{{--                <p1> Timetable Entity</p1>--}}
{{--                <a href="/office-assistant/user-application/user-application-list">View All</a>--}}
                <div id="cf6_image" class="shadow"></div>

{{--                 <div class="container-table-timetableentity">--}}
{{--                    <table>--}}
{{--                        <col class="col-program"/>--}}
{{--                        <col class="col-course"/>--}}
{{--                        <col class="col-venue"/>--}}
{{--                        <col class="col-meeting"/>--}}
{{--                        <col class="col-botton"/>--}}
{{--                        <tr>--}}
{{--                            <td style="color: #252733">MANAA1CKA-MASTER OF SCIENCE (INFORMATION ASSURANCE)(PACKAGE 2)--}}
{{--                            </td>--}}
{{--                            <td style="color: #252733">UANP0013-RESEARCH METHODOLOGY</td>--}}
{{--                            <td style="color: #252733">Lvl 3 Professional Training 1 (10pax)</td>--}}
{{--                            <td style="color: #252733">·meeting1：2023-01-01 9:00am--}}
{{--                                ·meeting2：2023-01-01 9:00am--}}
{{--                                ·meeting3：2023-01-01 9:00am--}}
{{--                                ·meeting4：2023-01-01 9:00am--}}
{{--                                ·meeting5：2023-01-01 9:00am--}}
{{--                                ·meeting6：2023-01-01 9:00am--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <input class="container-announcement-view" value="EDIT"--}}
{{--                                       onclick="javascript:window.location.href='/#'">--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td style="color: #252733">MANAA1CKA-MASTER OF SCIENCE (INFORMATION ASSURANCE)(PACKAGE 2)--}}
{{--                            </td>--}}
{{--                            <td style="color: #252733">UANP0013-RESEARCH METHODOLOGY</td>--}}
{{--                            <td style="color: #252733">Lvl 3 Professional Training 1 (10pax)</td>--}}
{{--                            <td style="color: #252733">·meeting1：2023-01-01 9:00am--}}
{{--                                ·meeting2：2023-01-01 9:00am--}}
{{--                                ·meeting3：2023-01-01 9:00am--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <input class="container-announcement-view" value="EDIT"--}}
{{--                                       onclick="javascript:window.location.href='/#'">--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    </table>--}}
{{--                </div>--}}
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
