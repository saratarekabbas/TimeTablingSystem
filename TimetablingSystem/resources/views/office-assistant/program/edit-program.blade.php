<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Program</title>
</head>
<body>
<h1>Edit Program</h1>

{{--This means, display success messge if an item is added successfullyS--}}
@if(Session::has('success'))
    {{--    This should be an alert--}}
    {{Session::get('success')}}
@endif


<form method="post" action="{{url('/office-assistant/program/update-program')}}">
    {{--    in laravel we want to use crf token, this is why we pass it--}}
    @csrf
    <input type="hidden" name="id" value="{{$data->id}}">

    <label>Program Name: </label>
    <input type="text" name="program_name" placeholder="Program Name..." value="{{$data->program_name}}">
    @error('program_name')
    {{$message}}
    @enderror
    <br>

    <label>Program Code: </label>
    <input type="text" name="program_code" placeholder="Program Code..." value="{{$data->program_code}}">
    @error('program_code')
    {{$message}}
    @enderror
    <br>

    <label>Program Package: </label>
    <input type="text" name="program_package" placeholder="Program Package..." value="{{$data->program_package}}">
    @error('program_package')
    {{$message}}
    @enderror
    <br>

    <button type="submit">UPDATE</button>

    <a href="{{url('/office-assistant/program/program-list')}}">Back</a>
</form>
</body>
</html>
