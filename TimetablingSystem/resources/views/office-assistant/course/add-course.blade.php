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
<h1>Add a New Program</h1>

{{--This means, display success messge if an item is added successfullyS--}}
@if(Session::has('success'))
    {{--    This should be an alert--}}
    {{Session::get('success')}}
@endif

<form method="post" action="{{url('/office-assistant/program/save-program')}}">
    {{--    in laravel we want to use crf token, this is why we pass it--}}
    @csrf
    <label>Program Name: </label>
    <input type="text" name="program_name" placeholder="Program Name..."
           value="{{old('program_name')}}">
    @error('program_name')
    {{$message}}
    @enderror
    <br>

    <label>Program Code: </label>
    <input type="text" name="program_code" placeholder="Program Code..."
           value="{{old('program_code')}}">
    @error('program_code')
    {{$message}}
    @enderror
    <br>

{{--        <label>Program Package: </label>--}}
{{--        <input type="checkbox" name="program_package[]" value="Package 1">Package 1<br   />--}}
{{--        <input type="checkbox" name="program_package[]" value="Package 2">Package 2<br   />--}}
{{--    @error('program_package')--}}
{{--    {{$message}}--}}
{{--    @enderror--}}
{{--    <br>--}}

    <button type="submit">CREATE</button>

    <a href="{{url('/office-assistant/program/program-list')}}">Back</a>
</form>
</body>
</html>
