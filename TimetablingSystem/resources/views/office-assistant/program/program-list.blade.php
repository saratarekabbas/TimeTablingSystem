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
    <title>Program List</title>
</head>
<body>

<div class="row">
    <div class="column side">
        <img src="/TtS-Logo.png" alt="TtS Logo">
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
{{--        <a href="/login">--}}
{{--            <i class="fa fa-sign-out" aria-hidden="true"></i>--}}
{{--            Logout</a>--}}
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <i class="fa fa-sign-out" aria-hidden="true"></i>
            <button type="submit" class="logout-btn">Logout</button>
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
                <p> List of Programs</p>
            </div>

            <div class="container-heading">
                <a href="{{url('/office-assistant/program/add-program')}}" class="container-action-btns">Add a New Program</a>
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
                        <th>Program Name</th>
                        <th>Program Code</th>
{{--                        <th>Program Package(s)</th>--}}
                        <th>Action</th>
                    </tr>
                    @php
                        $i = 1;
                    @endphp
                    @foreach($data as $programdata)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$programdata->program_name}}</td>
                            <td>{{$programdata->program_code}}</td>
{{--                            <td>--}}
{{--                                <ul>--}}
{{--                                    @foreach($programdata->program_package as $package)--}}
{{--                                    <li>{{$package}}</li>--}}
{{--                                    @endforeach--}}
{{--                                </ul>--}}
{{--                            </td>--}}
                            <td>
                                <a href="{{url('/office-assistant/program/edit-program/'.$programdata->id)}}"
                                   class="edit-btn">Edit</a>
                                <a href="{{url('/office-assistant/program/delete-program/'.$programdata->id)}}" onclick="return confirm('Are you sure you want to delete?')"
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

