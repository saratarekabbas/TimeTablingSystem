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
            <p1>
                Venues
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
            <p1>Create a New Venue</p1>
            <a href="/office-assistant/venue/venue-list">
                <i class="fa fa-arrow-left" aria-hidden="true"> BACK</i>
            </a>
            <div class="container-table-program">
                <form method="post" action="{{url('/office-assistant/venue/save-venue')}}">
                    {{--                    in laravel we want to use crf token, this is why we pass it--}}
                    @csrf
                    <table>
                        <col class="col-itemname"/>
                        <col class="col-inputbox"/>
                        <tr>
                            <td style="color: #252733">Venue Name</td>
                            <td style="color: red"><input type="text" class="create-edit-inputbox"
                                                          placeholder="Venue Name" name="venue_name"
                                                          value="{{old('venue_name')}}">
                                @error('venue_name')
                                {{$message}}
                                @enderror</td>
                        </tr>
                        <tr>
                            <td style="color: #252733">Venue Level</td>
                            <td style="color: red"><input type="text" class="create-edit-inputbox"
                                                          placeholder="Venue Level" name="venue_level"
                                                          value="{{old('venue_level')}}">
                                @error('venue_level')
                                {{$message}}
                                @enderror</td>
                        </tr>
                        <tr>
                            <td style="color: #252733">Venue Capacity</td>
                            <td style="color: red"><input type="text" class="create-edit-inputbox"
                                                          placeholder="Venue Capacity" name="venue_capacity"
                                                          value="{{old('venue_capacity')}}">
                                @error('venue_capacity')
                                {{$message}}
                                @enderror</td>
                        </tr>
                        <tr>
                            <td style="color: #252733">Venue Location</td>
                            <td style="color: red"><input type="text" class="create-edit-inputbox"
                                                          placeholder="Venue Location" name="venue_location"
                                                          value="{{old('venue_location')}}">
                                @error('venue_location')
                                {{$message}}
                                @enderror</td>
                        </tr>

                    </table>
                    {{--                <input class="container-create" value="CREATE">--}}
                    <button type="submit" class="create-edit-btn">CREATE</button>

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
</html>

{{--MY PART--}}


{{--<!doctype html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport"--}}
{{--          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
{{--    <title>Add Venue</title>--}}
{{--</head>--}}
{{--<body>--}}
{{--<h1>Add a New Venue</h1>--}}

{{--This means, display success messge if an item is added successfullyS--}}
{{--@if(Session::has('success'))--}}
{{--    --}}{{--    This should be an alert--}}
{{--    {{Session::get('success')}}--}}
{{--@endif--}}

{{--<form method="post" action="{{url('/office-assistant/venue/save-venue')}}">--}}
{{--    in laravel we want to use crf token, this is why we pass it--}}
{{--    @csrf--}}
{{--    <label>Venue Name: </label>--}}
{{--    <input type="text" name="venue_name" placeholder="Venue Name..."--}}
{{--           value="{{old('venue_name')}}">--}}
{{--    @error('venue_name')--}}
{{--    {{$message}}--}}
{{--    @enderror--}}
{{--    <br>--}}

{{--    <label>Venue Level: </label>--}}
{{--    <input type="text" name="venue_level" placeholder="Venue Level..."--}}
{{--           value="{{old('venue_level')}}">--}}
{{--    @error('venue_level')--}}
{{--    {{$message}}--}}
{{--    @enderror--}}
{{--    <br>--}}

{{--    <label>Venue Capacity: </label>--}}
{{--    <input type="text" name="venue_capacity" placeholder="Venue Capacity..."--}}
{{--           value="{{old('venue_capacity')}}">--}}
{{--    @error('venue_capacity')--}}
{{--    {{$message}}--}}
{{--    @enderror--}}

{{--    <br>--}}

{{--    <label>Venue Location: </label>--}}
{{--    <input type="text" name="venue_location" placeholder="Venue Location..."--}}
{{--           value="{{old('venue_location')}}">--}}
{{--    @error('venue_location')--}}
{{--    {{$message}}--}}
{{--    @enderror--}}

{{--    <br>--}}

{{--    <button type="submit">CREATE</button>--}}

{{--    <a href="{{url('/office-assistant/venue/venue-list')}}">Back</a>--}}
{{--</form>--}}
{{--</body>--}}
{{--</html>--}}
