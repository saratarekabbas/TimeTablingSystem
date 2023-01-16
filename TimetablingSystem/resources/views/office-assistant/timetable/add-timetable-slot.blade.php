<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Slot for a Timetable Entity</title>
</head>
<body>
<h1>Add Slot for Timetable Entity</h1>

{{--This means, display success messge if an item is added successfullyS--}}
@if(Session::has('success'))
    {{--    This should be an alert--}}
    {{Session::get('success')}}
@endif

<form method="post" action="{{url('/office-assistant/timetable/save-timetable-slot')}}">
    {{--    in laravel we want to use crf token, this is why we pass it--}}
    @csrf

    <input type="hidden" name="id" value="{{$timetable->id}}">

    <label>Meetings: </label>
    <ol>
        @for($i = 1; $i<= $meetings_number; $i++)
           <li> <input type="date" name="slots[]" value="{{$timetable->slots}}"></li>
        @endfor
    </ol>
    @error('slots')
    {{$message}}
    @enderror
    <br>

    <button type="submit">CREATE</button>

    <a href="{{url('/office-assistant/timetable/timetable-list')}}">Back</a>
</form>
</body>
</html>
