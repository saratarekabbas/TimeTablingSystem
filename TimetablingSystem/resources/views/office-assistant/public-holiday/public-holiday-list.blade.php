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
    {{--    <link rel="stylesheet" href="assets/font-awesome-4.7.0/css/font-awesome.min.css">--}}
    <link rel="stylesheet" href="/assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <title>Public Holiday List</title>
</head>
<body>

<div class="row">
    <div class="column side">
        <img src="/public/TtS-Logo.png" alt="TtS Logo">
        <p>Timetabling System</p>
        <a href="/office-assistant/overview"> <i class="fa fa-tachometer" aria-hidden="true"></i> Overview</a>
        <a href="/office-assistant/user-application/user-application-list"><i class="fa fa-user-plus" aria-hidden="true"></i>
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
                <p> List of Public Holidays </p>
            </div>

            <div class="container-heading">
                <a href="{{url('/office-assistant/public-holiday/add-public-holiday')}}" class="container-action-btns">Add
                    a New Public Holiday</a>
            </div>

            @if(Session::has('success'))
                {{--    This should be an alert--}}
                {{Session::get('success')}}
            @endif

            <div class="container-table">
                <table id="table">
                    <tr>
                        <th>#</th>
                        <th>Public Holiday</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Action</th>
                    </tr>
                    @php
                        $i = 1;
                    @endphp
                    @foreach($data as $publicholidaydata)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$publicholidaydata->public_holiday_title}}</td>
                            <td>{{$publicholidaydata->public_holiday_start_date}}</td>
                            <td>{{$publicholidaydata->public_holiday_end_date}}</td>
                            <td>
                                <a href="{{url('/office-assistant/public-holiday/edit-public-holiday/'.$publicholidaydata->id)}}"
                                   class="edit-btn">Edit</a>
                                <a href="{{url('/office-assistant/public-holiday/delete-public-holiday/'.$publicholidaydata->id)}}"
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

