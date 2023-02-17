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
            <img src="Reset_Password2.png">
        </div>
        <div class="reset-password-line">
        </div>
        <div class="login-column right-login-column">
            {{--            <form action="{{ route('reset-password') }}" method="GET">--}}
            {{--                @csrf--}}
            {{--                <input type="hidden" name="token" value="{{ $token }}">--}}
            {{--                <a href="#" class="reset-password-arrow">--}}
            {{--                    <img src="Reset-password-arrow.png">--}}
            {{--                </a>--}}
            {{--                <h1>Reset Your Password</h1>--}}
            {{--                <h2>Please, enter your new password.</h2>--}}
            {{--                <div class="form-group">--}}
            {{--                    <input type="email" name="email" class="form-control" value="{{ $email ?? old('email') }}" required--}}
            {{--                           autofocus>--}}
            {{--                </div>--}}
            {{--                <input type="password" class="login-inputbox" placeholder="New Password" name="password" required>--}}
            {{--                <input type="password" class="login-inputbox" placeholder="Confirm New Password"--}}
            {{--                       name="password_confirmation" required>--}}
            {{--                <button type="submit" class="login-submit">RESET PASSWORD</button>--}}
            {{--            </form>--}}


            {{--            <form action="{{ route('reset-password') }}" method="POST">--}}
            {{--                @csrf--}}
            {{--                <input type="hidden" name="token" value="{{ $token }}">--}}
            {{--                <a href="#" class="reset-password-arrow">--}}
            {{--                    <img src="Reset-password-arrow.png">--}}
            {{--                </a>--}}
            {{--                <h1>Reset Your Password</h1>--}}
            {{--                <h2>Please, enter your new password.</h2>--}}
            {{--                <div class="form-group">--}}
            {{--                    <input type="email" name="email" class="form-control" value="{{ $email ?? old('email') }}" required--}}
            {{--                           autofocus>--}}
            {{--                </div>--}}
            {{--                <input type="password" class="login-inputbox" placeholder="New Password" name="password" required>--}}
            {{--                <input type="password" class="login-inputbox" placeholder="Confirm New Password"--}}
            {{--                       name="password_confirmation" required>--}}
            {{--                <button type="submit" class="login-submit">RESET PASSWORD</button>--}}
            {{--            </form>--}}

            {{--            <form action="{{ route('password.reset') }}" method="POST">--}}
            {{--                @csrf--}}
            {{--                <input type="hidden" name="token" value="{{ $token }}">--}}
            {{--                <input type="email" name="email" value="{{ $email ?? old('email') }}" required>--}}
            {{--                <input type="password" name="password" required>--}}
            {{--                <input type="password" name="password_confirmation" required>--}}
            {{--                <button type="submit">Reset Password</button>--}}
            {{--            </form>--}}

            <form action="{{ route('password.reset', ['token' => $token]) }}" method="POST">
                @csrf
                <input type="email" name="email" value="{{ $email ?? old('email') }}" required hidden>
                <a href="login.blade.php" class="reset-password-arrow">
                    <img src="Reset-password-arrow.png">
                </a>
                <h1>Reset Your Password</h1>
                <h2>Please, enter your new password.</h2>
                <div class="form-group">
{{--                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>--}}
                </div>
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
