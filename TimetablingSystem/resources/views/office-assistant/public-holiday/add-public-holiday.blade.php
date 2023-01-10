<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Public Holiday</title>
</head>
<body>
<h1>Add a New Public Holiday</h1>

{{--This means, display success messge if an item is added successfullyS--}}
@if(Session::has('success'))
    {{--    This should be an alert--}}
    {{Session::get('success')}}
@endif


<form method="post" action="{{url('/office-assistant/public-holiday/save-public-holiday')}}">
    {{--    in laravel we want to use crf token, this is why we pass it--}}
    @csrf
    <label>Public Holiday Title: </label>
    <input type="text" name="public_holiday_title" placeholder="Public Holiday Title..." value="{{old('public_holiday_title')}}">
    @error('public_holiday_title')
    {{$message}}
    @enderror
    <br>

    <label>Public Holiday Start Date: </label>
    <input type="text" name="public_holiday_start_date" placeholder="Public Holiday Start Date (YYYY-MM-DD)..." value="{{old('public_holiday_start_date')}}">
    @error('public_holiday_start_date')
    {{$message}}
    @enderror
    <br>

    <label>Public Holiday End Date: </label>
    <input type="text" name="public_holiday_end_date" placeholder="Public Holiday End Date (YYYY-MM-DD)..." value="{{old('public_holiday_end_date')}}">
    @error('public_holiday_end_date')
    {{$message}}
    @enderror

    <br>
    <button type="submit">CREATE</button>

    <a href="{{url('/office-assistant/public-holiday/public-holiday-list')}}">Back</a>
</form>
</body>
</html>
