<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Timetable Slots</title>
</head>
<body>
<h1>Add Timetable Slots for the Selected Entity</h1>

{{--This means, display success messge if an item is added successfullyS--}}
@if(Session::has('success'))
    {{--    This should be an alert--}}
    {{Session::get('success')}}
@endif

<form method="post" action="{{url('/office-assistant/timetable/save-timetable-slots')}}">
    @csrf
    <label>Meetings: </label>

    <ul>
        @foreach($findCourse as $meeting_number)

            @for($count=1; $count <=$meeting_number->number_of_meetings; $count++)
                <li>Meeting {{$count}}:
                    <input type="date" name="slot[]" placeholder="Meeting Date (YYYY-MM-DD)">
                </li>
            @endfor
    </ul>
    @endforeach
    @error('slot')
    {{$message}}
    @enderror
    <br>
    <button type="submit">PROCEED</button>
    <a href="{{url('/office-assistant/timetable/timetable-list')}}">Back</a>
</form>
</body>
</html>
