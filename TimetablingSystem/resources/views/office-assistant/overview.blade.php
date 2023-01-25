{{--This Page Contains the list of all public holidays--}}

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
        <a href="/login">
            <i class="fa fa-sign-out" aria-hidden="true"></i>
            Logout</a>
    </div>

    <div class="column right">
        <div class="header">
            <p1>
                Overview
            </p1>
            <p>Office Assistant
                <i class="fa fa-user-circle fa-3x" aria-hidden="true" style="color:darkslateblue"></i>
            </p>
        </div>

        {{--        ////////////////////--}}

        {{--        container for the page content--}}
        <div class="container-bulletin">
            <div class="container-bulletin1">
                <p1> Total Lecturers</p1>

                @php
                    $lecturers = \App\Models\Lecturer::all();
                    $i = 0;
                foreach($lecturers as $lecturer){
                    if($lecturer->lecturer_registration_status == 'approved'){
                        $i++;
                    }
                }
                @endphp
                <p2> {{$i}}</p2>
            </div>
            <div class="container-bulletin2">
                <p1> Total Programs</p1>
                @php
                    $programs = \App\Models\Program::all();
                    $i = 0;
                foreach($programs as $program){
                        $i++;
                }
                @endphp
                <p2> {{$i}}</p2>
            </div>
            <div class="container-bulletin3">
                <p1> Total Venues</p1>
                @php
                    $venues = \App\Models\Venue::all();
                    $i = 0;
                foreach($venues as $venue){
                        $i++;
                }
                @endphp
                <p2> {{$i}}</p2>
            </div>
            <div class="container-bulletin4">
                <p1> Total Courses</p1>
                @php
                    $courses = \App\Models\Course::all();
                    $i = 0;
                foreach($courses as $course){
                        $i++;
                }
                @endphp
                <p2> {{$i}}</p2>
            </div>
        </div>
        <div class="container-announcement">
            <div class="container-announcement1">
                <p1> Pending Applications</p1>
                <a href="/office-assistant/user-application/user-application-list">View All</a>
                <div class="container-table-officeassistantoverview">
                    <table>
                        <col class="col1"/>
                        <col class="col2"/>
                        <tr>
                            <td style="color: #252733">January</td>
                            <td style="color: #9FA2B4">$100</td>
                        </tr>
                        <tr>
                            <td style="color: #252733">February</td>
                            <td style="color: #9FA2B4">$80</td>
                        </tr>
                        <tr>
                            <td style="color: #252733">January</td>
                            <td style="color: #9FA2B4">$100</td>
                        </tr>
                        <tr>
                            <td style="color: #252733">February</td>
                            <td style="color: #9FA2B4">$80</td>
                    </table>
                </div>
            </div>
            <div class="container-announcement2">
                <p1> Programs</p1>
                <a href="/office-assistant/program/program-list">View All</a>
                <div class="container-table-officeassistantoverview">
                    <table>
                        <col class="col1"/>
                        <col class="col2"/>
                        <tr>
                            <td style="color: #C5C7CD">Add a new program</td>
                            <td>
                                <i class="fa fa-plus-square-o" aria-hidden="true"
                                   onclick="javascript:window.location.href='/#'"></i>
                                {{--                                <input class="container-announcement-view" value="VIEW" onclick="javascript:window.location.href='/#'" >--}}
                            </td>
                        </tr>
                        <tr>
                            <td style="color: #252733">February</td>
                            <td>
                                <input class="container-announcement-view" value="VIEW"
                                       onclick="javascript:window.location.href='/#'">
                            </td>
                        </tr>
                        <tr>
                            <td style="color: #252733">January</td>
                            <td>
                                <input class="container-announcement-view" value="VIEW"
                                       onclick="javascript:window.location.href='/#'">
                            </td>
                        </tr>
                        <tr>
                            <td style="color: #252733">February</td>
                            <td>
                                <input class="container-announcement-view" value="VIEW"
                                       onclick="javascript:window.location.href='/#'">
                            </td>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


{{--        MINEEEEEEEEEEEEEEEEEEEEE--}}

{{--        container for the page content--}}
{{--<div class="container">--}}
{{--    <div class="container-title">--}}
{{--        <p>All Pending Requests</p>--}}
{{--    </div>--}}

{{--    @if(Session::has('success'))--}}
{{--        --}}{{--    This should be an alert--}}
{{--        {{Session::get('success')}}--}}
{{--    @endif--}}

{{--    <div class="container-table">--}}
{{--        <table id="table">--}}
{{--            <tr>--}}
{{--                <th>#</th>--}}
{{--                <th>Lecturer Name</th>--}}
{{--                <th>Lecturer Email</th>--}}
{{--                <th>Respond</th>--}}
{{--            </tr>--}}
{{--            @php--}}
{{--                $i = 1;--}}
{{--            @endphp--}}
{{--            @foreach($data as $userapplicationdata)--}}
{{--                <tr>--}}
{{--                    <td>{{$i++}}</td>--}}
{{--                    <td>{{$userapplicationdata->lecturer_name}}</td>--}}
{{--                    <td>{{$userapplicationdata->lecturer_email}}</td>--}}
{{--                    <td>--}}
{{--                        <a href="{{url('/office-assistant/user-application/approve-user-application/'.$userapplicationdata->id)}}"--}}
{{--                           class="edit-btn">Approve</a>--}}
{{--                        <a href="{{url('/office-assistant/user-application/disapprove-user-application/'.$userapplicationdata->id)}}"--}}
{{--                           class="delete-btn">Disapprove</a>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--        </table>--}}
{{--    </div>--}}
{{--</div>--}}
</div>
</div>

{{--all components are added/replaced/shown here--}}
{{--{{$slot}}--}}

{{--footer--}}
<div class="footer">Created by SSZ Solutions. © 2023</div>

</body>
</html>

