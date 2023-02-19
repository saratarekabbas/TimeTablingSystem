<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/app.css">
    <title>Password Reset Page</title>
</head>
<body>
<div class="login-page">
    <div class="login-content">
        <div class="login-column left-login-column2">
            <img src="/Reset_Password2.png">
        </div>
        <div class="reset-password-line">
        </div>
        <div class="login-column right-login-column">
            <form action="{{ route('password.reset', ['token' => $token]) }}" method="PATCH">
                @csrf
                <input type="email" name="email" value="{{ $email ?? old('email') }}" required hidden>
{{--                <a href="login" class="reset-password-arrow">--}}
{{--                    <img src="/Reset-password-arrow.png">--}}
{{--                    <i class="fa fa-arrow-left" aria-hidden="true"></i>--}}
{{--                </a>--}}
                <h1>Reset Your Password</h1>
                <h2>Please, enter your new password.</h2>
{{--                <div class="form-group">--}}
{{--                </div>--}}
                <input type="password" class="login-inputbox" placeholder="New Password" name="password" required>
                <input type="password" class="login-inputbox" placeholder="Confirm New Password"
                       name="password_confirmation" required>


                <button type="submit" class="login-submit">RESET PASSWORD</button>
            </form>
        </div>
    </div>

    <div class="footer">Created by SSZ Solutions. © 2023</div>
</div>
</body>
</html>
