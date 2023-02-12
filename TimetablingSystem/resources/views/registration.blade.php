<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/app.css">
    <title>Registration Page</title>
</head>
<body>

<div class="login-page">
    <div class="login-content">
        <div class="login-header">
            <img class="login-img" src="/TtS-Logo-White.png">
            <h1>Timetabling System</h1>
            <h2>Register an account now.</h2>
        </div>


        <div class="login-form">
            @if(Session::has('success'))
                {{--    This should be an alert--}}
                {{Session::get('success')}}
            @endif
            <form method="post" action="{{url('/registration')}}">
                @csrf
                <input type="text" class="login-inputbox" placeholder="Full Name" id="name" name="name">

                @error('name')
                {{$message}}
                @enderror

                <input type="email" class="login-inputbox" placeholder="Email Address" id="email" name="email">
                @error('email')
                {{$message}}
                @enderror
                <input type="password" class="login-inputbox" placeholder="Password" id="password" name="password">
                @error('password')
                {{$message}}
                @enderror

                <button type="submit" class="login-submit" id="registerBtn">REGISTER</button>

                <a href="/login" class="login-forgotpassword forgotpasswordB">Already have an account? <b>Login
                        here.</b></a>
            </form>
        </div>
    </div>

    <div class="footer">Created by SSZ Solutions. © 2023</div>


</div>
</body>
</html>
