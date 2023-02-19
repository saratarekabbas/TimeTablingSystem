{{--This Page Contains the list of all Programs--}}
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
    <link rel="stylesheet" href="/app.css">
    <script src="/app.js"></script>
    <link rel="stylesheet" href="/assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <title>Timetable Entities</title>
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
                {{$userName}}                {{--                <i class="fa fa-sign-out" aria-hidden="true"></i>--}}
                <i class="fa fa-user-circle fa-3x" aria-hidden="true" style="color:darkslateblue"></i>
            </p2>
        </div>

        {{--        container for the page content--}}
        <div class="container">
            <div class="container-title">
                <p>Calendar View</p>
            </div>

            <div class="container-heading">
                <div class="dropdown">
                    <button onclick="myFunction3()" class="dropbtn"><i class="fa fa-filter" aria-hidden="true"></i>
                        Filter
                    </button>
                    <div id="myDropdown3" class="dropdown-content">

                        <input type="text" placeholder="Search.." id="myInput3" onkeyup="filterFunction3()">
                        <a href="{{url('/lecturer/lecturer-view-calendar')}}">All Programs</a>
                        @php
                            $programs = \App\Models\Program::all();
                        @endphp
                        @foreach($programs as $program)
                            <a href="{{url('/lecturer/lecturer-view-calendar/'.$program->id)}}">{{$program->program_code}}
                                - {{$program->program_name}}</a>
                        @endforeach
                    </div>
                </div>

                <script>
                    /* When the user clicks on the button,
                    toggle between hiding and showing the dropdown content */
                    function myFunction3() {
                        document.getElementById("myDropdown3").classList.toggle("show");
                    }

                    function filterFunction3() {
                        var input, filter, ul, li, a, i;
                        input = document.getElementById("myInput3");
                        filter = input.value.toUpperCase();
                        div = document.getElementById("myDropdown3");
                        a = div.getElementsByTagName("a");
                        for (i = 0; i < a.length; i++) {
                            txtValue = a[i].textContent || a[i].innerText;
                            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                a[i].style.display = "";
                            } else {
                                a[i].style.display = "none";
                            }
                        }
                    }
                </script>
            </div>
            @if(Session::has('success'))
                {{--                This should be an alert--}}
                {{Session::get('success')}}
            @endif

            <div class="container-table">
                <div id="calendar">
                </div>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
                        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
                        crossorigin="anonymous"></script>
                <script>
                    $(document).ready(function () {
                        var meetings = @json($meetings);
                        $('#calendar').fullCalendar({
                            header: {
                                left: 'prev,next, today',
                                center: 'title',
                                right: 'month, agendaWeek, agendaDay'
                            },
                            events: meetings,
                            selectable: true,
                            selectHelper: true,
                        })
                    });
                </script>
            </div>
        </div>
    </div>
</div>

{{--all components are added/replaced/shown here--}}
{{--{{$slot}}--}}

{{--footer--}}
<div class="footer">Created by SSZ Solutions. © 2023</div>

</body>
</html>
