<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Program</title>
</head>
<body>
<h1>Add a New Timetable Entity</h1>

{{--This means, display success messge if an item is added successfullyS--}}
@if(Session::has('success'))
    {{--    This should be an alert--}}
    {{Session::get('success')}}
@endif

<form method="post" action="{{url('/office-assistant/timetable/save-timetable')}}">
    @csrf

    <label>Program: </label>
    @foreach($programs as $program)
        <a href="{{url('/office-assistant/timetable/add-timetable/'.$program->id)}}">{{$program->program_code}}
            - {{$program->program_name}}</a>
    @endforeach
    @error('program_id')
    {{$message}}
    @enderror
    <br>

    <label>Course: </label>

    @foreach($courses as $course)
        <a href="{{url('/office-assistant/timetable/add-timetable/'.$course->program_id.'/'.$course->id)}}">{{$course->course_code}}
            - {{$course->course_name}}</a>
    @endforeach
    @error('course_id')
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
    <button type="submit">PROCEED TO ADD TIMETABLE SLOTS</button>
    <a href="{{url('/office-assistant/timetable/timetable-list')}}">Back</a>
</form>
</body>
</html>
