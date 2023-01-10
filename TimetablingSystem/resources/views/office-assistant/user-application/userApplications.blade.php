{{--This Page Contains the list of all public holidays--}}

    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/app.css">
    <script src="/app.js"></script>
    <link rel="stylesheet" href="assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <title>Timetabling System</title>
</head>
<body>

<div class="row">
    <div class="column side">
        <img src="TtS-Logo.png" alt="Logo">
        <p> Timetabling System</p>
        <a href="#"> <i class="fa fa-tachometer" aria-hidden="true"></i> Overview</a>
        <a href="#"><i class="fa fa-user-plus" aria-hidden="true"></i>
            User Applications</a>
        <a href="/publicHoliday"><i class="fa fa-plane" aria-hidden="true"></i>
            Public Holidays</a>
        <a href="#"><i class="fa fa-building" aria-hidden="true"></i>
            Programs</a>
        <a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i>
            Venues</a>
        <a href="#"><i class="fa fa-server" aria-hidden="true"></i>
            Courses</a>
        <a href="#">
            <i class="fa fa-calendar" aria-hidden="true"></i>
            Timetable</a>
    </div>

    <div class="column right">
        <div class="header">
            <p>Office Admin
                <i class="fa fa-sign-out" aria-hidden="true"></i>
            </p>
        </div>

        {{--        container for the page content--}}
        <div class="container">
            <div class="container-title">
                <p>All Pending Requests</p>
            </div>

            <div class="container-table">
                <table id="table">
                    <tr>
                        <th>Lecturer Name</th>
                        <th>Lecturer Email</th>
                        <th>Respond</th>
                    </tr>
                    <tr>
                        <td>Dr Othman</td>
                        <td>email@gmail.com</td>
                        <td>
                            <button class="edit-btn">Approve</button>
                            <button class="delete-btn">Disapprove</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Dr Othman</td>
                        <td>email@gmail.com</td>
                        <td>
                            <button class="edit-btn">Approve</button>
                            <button class="delete-btn">Disapprove</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Dr Othman</td>
                        <td>email@gmail.com</td>
                        <td>
                            <button class="edit-btn">Approve</button>
                            <button class="delete-btn">Disapprove</button>
                        </td>
                    </tr>



                </table>
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

