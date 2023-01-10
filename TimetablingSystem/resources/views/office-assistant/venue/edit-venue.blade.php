<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Venue</title>
</head>
<body>
<h1>Edit Venue</h1>

{{--This means, display success messge if an item is added successfullyS--}}
@if(Session::has('success'))
    {{--    This should be an alert--}}
    {{Session::get('success')}}
@endif


<form method="post" action="{{url('/office-assistant/venue/update-venue')}}">
    {{--    in laravel we want to use crf token, this is why we pass it--}}
    @csrf
    <input type="hidden" name="id" value="{{$data->id}}">

    <label>Venue Name: </label>
    <input type="text" name="venue_name" placeholder="Venue Name..." value="{{$data->venue_name}}">
    @error('venue_name')
    {{$message}}
    @enderror
    <br>

    <label>Venue Level: </label>
    <input type="text" name="venue_level" placeholder="Venue Level..." value="{{$data->venue_level}}">
    @error('venue_level')
    {{$message}}
    @enderror
    <br>

    <label>Venue Capacity: </label>
    <input type="text" name="venue_capacity" placeholder="Venue Capacity..." value="{{$data->venue_capacity}}">
    @error('venue_capacity')
    {{$message}}
    @enderror
    <br>

    <label>Venue Location: </label>
    <input type="text" name="venue_location" placeholder="Venue Location..." value="{{$data->venue_location}}">
    @error('venue_location')
    {{$message}}
    @enderror

    <br>
    <button type="submit">UPDATE</button>

    <a href="{{url('/office-assistant/venue/venue-list')}}">Back</a>
</form>
</body>
</html>
