@php
    use Illuminate\Support\Facades\Auth;
    use App\Models\User;
use App\Models\Course;
use App\Models\Timetable;
use App\Models\Venue;
@endphp

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/app.css">
    <script src="/app.js"></script>
    <link rel="stylesheet" href="/assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <title>Edit Timetable Slot</title>
</head>

<body>

<div class="row">
    <div class="column side">
        <img src="/TtS-Logo.png" alt="TtS Logo">
        <p>Timetabling System</p>
        <a href="/lecturer/overview"> <i class="fa fa-tachometer" aria-hidden="true"></i>Overview</a>
        <a href="/lecturer/view-schedule"><i class="fa fa-server" aria-hidden="true"></i>
            Schedule</a>
        {{--        LOGOUT--}}
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <i class="fa fa-sign-out" aria-hidden="true"></i>
            <button type="submit" class="logout-btn">Logout</button>
        </form>



    </div>

    <div class="column right">
        <div class="header">
            <p1>
                Edit Timetable Slot
            </p1>
            <p2>
                @php
                    $user = Auth::user();
                    $userName = ($user instanceof User) ? $user->name : "Lecturer";
                @endphp
                {{$userName}}
                <i class="fa fa-user-circle fa-3x" aria-hidden="true" style="color:darkslateblue"></i>
            </p2>
        </div>
        <div class="success-message">
            @if(Session::has('success'))
                {{Session::get('success')}}
            @endif
        </div>
        <div class="container-program">
            <p1>Meetings</p1>
            <a href="/lecturer/view-schedule">
                <i class="fa fa-arrow-left" aria-hidden="true"> BACK</i>
            </a>
            <div class="container-table-program">
                <form method="post" action="{{url(('/lecturer/schedule/update-schedule-slot'))}}">
                    {{--    in laravel we want to use crf token, this is why we pass it--}}
                    @csrf
                    <input type="hidden" name="id" value="{{$timetable->id}}">
                    <table>
                        <col class="col-itemname"/>
                        <col class="col-inputbox"/>
                        @php $i = 1; @endphp
                        @foreach($timetable->slots as $slot)
                            <tr>
                                <td style="color: #252733">Meeting {{ $i++ }}</td>
                                <td style="color: red">
                                    <input type="date" class="create-edit-inputbox" name="slots[]" value="{{$slot}}" required>
                                                    @if($errors->has("slots.{$i}"))
                                                        <p style="color:red;">{{ $errors->first("slots.{$i}") }}</p>
                                                    @endif
{{--                                    @error('slots.' . $i)--}}
{{--                                    <p style="color:red;">{{ $message }}</p>--}}
{{--                                    @enderror--}}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td style="color: #252733">Remark</td>
                            <td style="color: red">
                                <input type="text" class="create-edit-inputbox" name="remarks" value="{{$timetable->remarks}}">
                    </table>
                    <button type="submit" class="create-edit-btn">UPDATE</button>

                </form>
            </div>
        </div>
    </div>
</div>

{{--all components are added/replaced/shown here--}}
{{--{{$slot}}--}}

{{--footer--}}
<div class="footer">Created by SSZ Solutions. © 2023</div>

</body>








{{--<body>--}}
{{--<h1>Edit Timetable Slot</h1>--}}
{{--<a href="{{url('/lecturer/view-schedule')}}">--}}
{{--    <i class="fa fa-arrow-left" aria-hidden="true"> BACK</i>--}}
{{--</a>--}}

{{--This means, display success messge if an item is added successfullyS--}}
{{--@if(Session::has('success'))--}}
{{--    --}}{{----}}{{--    This should be an alert--}}
{{--    {{Session::get('success')}}--}}
{{--@endif--}}

{{--@if (session()->has('success'))--}}
{{--    {{ session('success') }}--}}
{{--@endif--}}


{{--<form method="post" action="{{url('/lecturer/schedule/update-schedule-slot')}}">--}}
{{--    @csrf--}}
{{--    <input type="hidden" name="id" value="{{$timetable->id}}">--}}
{{--    <ol>--}}
{{--        @foreach($timetable->slots as $slot)--}}
{{--            <li><input type="date" name="slots[]" value="{{$slot}}" required></li>--}}
{{--        @endforeach--}}
{{--    </ol>--}}

{{--    @error('course_name')--}}
{{--    {{$message}}--}}
{{--    @enderror--}}
{{--    <br>--}}

{{--    <input type="text" name="remarks" value="Remarks">--}}

{{--    <br>--}}
{{--    <button type="submit">UPDATE</button>--}}


{{--</form>--}}
{{--</body>--}}
</html>
