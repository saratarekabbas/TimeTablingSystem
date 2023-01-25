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
    <link rel="stylesheet" href="assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <title>Timetabling System</title>
</head>
<body>

<div class="row">
    <div class="column side">
        <img src="/TtS-Logo.png" alt="TtS Logo">
        <p>Timetabling System</p>
        <a href="/office-assistant/overview"> <i class="fa fa-tachometer" aria-hidden="true"></i> Overview</a>
        {{--        <a href="/office-assistant/user-application/user-application-list"><i class="fa fa-user-plus" aria-hidden="true"></i>--}}
        {{--            User Applications</a>--}}
        {{--        <a href="/office-assistant/public-holiday/public-holiday-list"><i class="fa fa-plane" aria-hidden="true"></i>--}}
        {{--            Public Holidays</a>--}}
        {{--        <a href="/office-assistant/program/program-list"><i class="fa fa-building" aria-hidden="true"></i>--}}
        {{--            Programs</a>--}}
        {{--        <a href="/office-assistant/venue/venue-list"><i class="fa fa-map-marker" aria-hidden="true"></i>--}}
        {{--            Venues</a>--}}
        {{--        <a href="/office-assistant/course/course-list"><i class="fa fa-server" aria-hidden="true"></i>--}}
        {{--            Courses</a>--}}
        <a href="/office-assistant/timetable/timetable-list">
            <i class="fa fa-calendar" aria-hidden="true"></i>
            Timetable</a>
    </div>

    <div class="column right">
        <div class="header">
            <p1>
                Overview
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                <i class="fa fa-sign-out" aria-hidden="true"></i>
            </p1>
            <p2>Othman Yusop
                <i class="fa fa-sign-out" aria-hidden="true"></i>
            </p2>
        </div>


        {{--        container for the page content--}}
        <div class="container-bulletin">
            <div class="container-comingclass">
                <p3> Coming Class </p3>
                <p4> 2023-01-01 9:00am <br> MANP1163(02)</p4>
            </div>
            <div class="container-comingclassvenue">
                <p3> Coming Class Venue </p3>
                <p4> Lvl 3 Professional Training <br> (10pax) </p4>
            </div>
        </div>
        <div class="container-announcement">
            <div class="container-announcement-viewtimetableentity">
                <p1> Timetable Entity </p1>
                <a href="/office-assistant/user-application/user-application-list">View All</a>
                <div class="container-table-timetableentity">
                    <table>
                        <col class="col-program" />
                        <col class="col-course" />
                        <col class="col-venue" />
                        <col class="col-meeting" />
                        <col class="col-botton" />
                        <tr>
                            <td style="color: #252733">MANAA1CKA-MASTER OF SCIENCE (INFORMATION ASSURANCE)(PACKAGE 2)</td>
                            <td style="color: #252733">UANP0013-RESEARCH METHODOLOGY</td>
                            <td style="color: #252733">Lvl 3 Professional Training 1 (10pax)</td>
                            <td style="color: #252733">·meeting1：2023-01-01 9:00am
                                ·meeting2：2023-01-01 9:00am
                                ·meeting3：2023-01-01 9:00am
                                ·meeting4：2023-01-01 9:00am
                                ·meeting5：2023-01-01 9:00am
                                ·meeting6：2023-01-01 9:00am
                            </td>
                            <td>
                                <input class="container-announcement-view" value="EDIT" onclick="javascript:window.location.href='/#'" >
                            </td>
                        </tr>
                        <tr>
                            <td style="color: #252733">MANAA1CKA-MASTER OF SCIENCE (INFORMATION ASSURANCE)(PACKAGE 2)</td>
                            <td style="color: #252733">UANP0013-RESEARCH METHODOLOGY</td>
                            <td style="color: #252733">Lvl 3 Professional Training 1 (10pax)</td>
                            <td style="color: #252733">·meeting1：2023-01-01 9:00am
                                ·meeting2：2023-01-01 9:00am
                                ·meeting3：2023-01-01 9:00am
                            </td>
                            <td>
                                <input class="container-announcement-view" value="EDIT" onclick="javascript:window.location.href='/#'" >
                            </td>
                        </tr>
                    </table>
                </div>
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