<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Timetable Entity</title>
</head>
<body>
<h1>Edit Timetable Entity</h1>

{{--This means, display success messge if an item is added successfullyS--}}
@if(Session::has('success'))
    {{--    This should be an alert--}}
    {{Session::get('success')}}
@endif

<a href="{{url('/office-assistant/timetable/timetable-list')}}">
    <i class="fa fa-arrow-left" aria-hidden="true"> BACK</i>
</a>

<form method="post" action="{{url('/office-assistant/timetable/update-timetable')}}">
    @csrf
    <input type="hidden" name="id" value="{{$timetable->id}}">
    <label>Course: </label>
       <input type="text" placeholder="Course" name="course_id"  disabled
              value="{{$course->course_name}}">
    </select>
    @error('course_name')
    {{$message}}
    @enderror
    <br>

    <label>Venue: </label>
    @php
        $venues = \App\Models\Venue::all();
    @endphp
    <select name="venue_id">
        @foreach($venues as $venue)
            <option value="{{$venue->id}}">{{$venue->venue_name}}, {{$venue->venue_level}}, {{$venue->venue_location}}
                ({{$venue->venue_capacity}} pax)
            </option>
        @endforeach
    </select>
    @error('venue_id')
    {{$message}}
    @enderror
    <br>

    <button type="submit">UPDATE</button>


</form>
</body>
</html>
