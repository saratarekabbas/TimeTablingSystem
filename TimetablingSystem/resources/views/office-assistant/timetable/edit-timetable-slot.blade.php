<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Timetable Slot</title>
</head>
<body>
<h1>Edit Timetable Slot</h1>

{{--This means, display success messge if an item is added successfullyS--}}
@if(Session::has('success'))
    {{--    This should be an alert--}}
    {{Session::get('success')}}
@endif

<a href="{{url('/office-assistant/timetable/timetable-list')}}">
    <i class="fa fa-arrow-left" aria-hidden="true"> BACK</i>
</a>

<form method="post" action="{{url('/office-assistant/timetable/update-timetable-slot')}}">
    @csrf
    <input type="hidden" name="id" value="{{$timetable->id}}">
    <ol>
{{--        @for($i = 1; $i<= $meetings_number; $i++)--}}
{{--            <li> </li>--}}
{{--        @endfor--}}

                @foreach($timetable->slots as $slot)
                    <li> <input type="date" name="slots[]" value="{{$slot}}"></li>
                @endforeach
    </ol>
    @error('course_name')
    {{$message}}
    @enderror
    <br>


    <button type="submit">UPDATE</button>


</form>
</body>
</html>
