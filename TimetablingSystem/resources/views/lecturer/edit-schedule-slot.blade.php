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



<a href="{{url('/lecturer/view-schedule')}}">
    <i class="fa fa-arrow-left" aria-hidden="true"> BACK</i>
</a>

{{--This means, display success messge if an item is added successfullyS--}}
{{--@if(Session::has('success'))--}}
{{--    --}}{{--    This should be an alert--}}
{{--    {{Session::get('success')}}--}}
{{--@endif--}}

@if (session()->has('success'))
    {{ session('success') }}
@endif


<form method="post" action="{{url('/lecturer/schedule/update-schedule-slot')}}">
    @csrf
    <input type="hidden" name="id" value="{{$timetable->id}}">
    <ol>
        @foreach($timetable->slots as $slot)
            <li><input type="date" name="slots[]" value="{{$slot}}" required></li>
        @endforeach
    </ol>

    @error('course_name')
    {{$message}}
    @enderror
    <br>

    <input type="text" name="remarks" value="Remarks">

    <br>
    <button type="submit">UPDATE</button>


</form>
</body>
</html>
