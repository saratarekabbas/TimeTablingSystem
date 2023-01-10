{{--This Page Contains the list of all Venues--}}

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
    <title>Venue List</title>
</head>
<body>

<div class="row">
    <div class="column side">
        <img src="/public/TtS-Logo.png" alt="TtS Logo">
        <p>Timetabling System</p>
        <a href="#"> <i class="fa fa-tachometer" aria-hidden="true"></i> Overview</a>
        <a href="#"><i class="fa fa-user-plus" aria-hidden="true"></i>
            User Applications</a>
        <a href="/venue"><i class="fa fa-plane" aria-hidden="true"></i>
            Public Holidays</a>
        <a href="#"><i class="fa fa-building" aria-hidden="true"></i>
            Programs</a>
        <a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i>
            Venues</a>
        <a href="#"><i class="fa fa-server" aria-hidden="true"></i>
            Courses</a>
        <a href="#">
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
                <p> List of Venues</p>
            </div>

            <div class="container-heading">
                <a href="{{url('/office-assistant/venue/add-venue')}}" class="container-action-btns">Add a New Venue</a>
            </div>

            @if(Session::has('success'))
                {{--    This should be an alert--}}
                {{Session::get('success')}}
            @endif

            <div class="container-table">
                <table id="table">
                    <tr>
                        <th>#</th>
                        <th>Venue Name</th>
                        <th>Venue Level</th>
                        <th>Venue Capacity</th>
                        <th>Venue Location</th>
                        <th>Action</th>
                    </tr>
                    @php
                        $i = 1;
                    @endphp
                    @foreach($data as $venuedata)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$venuedata->venue_name}}</td>
                            <td>{{$venuedata->venue_level}}</td>
                            <td>{{$venuedata->venue_capacity}}</td>
                            <td>{{$venuedata->venue_location}}</td>
                            <td>
                                <a href="{{url('/office-assistant/venue/edit-venue/'.$venuedata->id)}}"
                                   class="edit-btn">Edit</a>
                                <a href="{{url('/office-assistant/venue/delete-venue/'.$venuedata->id)}}"
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

