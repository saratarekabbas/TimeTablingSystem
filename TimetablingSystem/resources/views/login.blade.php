<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/app.css">

    <title>Login Page</title>
</head>
<body>

<div class="login-page">
    <div class="login-content">
        <div class="login-header">
            <img class="login-img" src="/TtS-Logo-White.png">
            <h1>Timetabling System</h1>
            <h2>Login to access your profile</h2>
        </div>

        <div class="login-form">
{{--            @if(Session::has('success'))--}}
{{--                --}}{{--    This should be an alert--}}
{{--                {{Session::get('success')}}--}}
{{--            @endif--}}


{{--            <?php if (isset($_SESSION['success'])): ?>--}}
{{--            <div class="alert alert-success">--}}
{{--                <?php echo $_SESSION['success']; ?>--}}
{{--            </div>--}}
{{--            <?php unset($_SESSION['success']); ?>--}}
{{--            <?php endif; ?>--}}

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif


                <form method="post" action="{{url('/login')}}">
                @csrf
                <input type="text" class="login-inputbox" placeholder="Email Address" name="email">
                    @error('email')
                    {{$message}}
                    @enderror
                <input type="password" class="login-inputbox" placeholder="Password" name="password">
                    @error('password')
                    {{$message}}
                    @enderror
                <a href="forgot-password" class="login-forgotpassword forgotpasswordA">Forgot Password?</a>

                    <button type="submit" class="login-submit" id="registerBtn">LOGIN</button>

                <a href="/registration" class="login-forgotpassword forgotpasswordB">No account yet? <b>Register here.</b></a>
            </form>
        </div>
    </div>

    <div class="footer">Created by SSZ Solutions. © 2023</div>

</div>
</body>
</html>
