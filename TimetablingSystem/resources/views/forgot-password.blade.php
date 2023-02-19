<!-- forgot-password.blade.php -->

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
    <title>Forgot Password</title>
</head>
<body>

<div class="login-page">
    <div class="login-content">
        <div class="login-column left-login-column">
            <img src="Reset_Password.png">
        </div>
        <div class="reset-password-line">
        </div>
        <div class="login-column right-login-column">

            <form action="{{ route('password.email') }}" method="POST">
                @csrf
{{--                <a href="login" class="reset-password-arrow">--}}
{{--                    <img src="/Reset-password-arrow.png">--}}
                <a href="login">
                    <i class="fa fa-arrow-left" aria-hidden="true"> BACK</i>

                </a>

                <h1>Forgot Password</h1>
                <h2>Lost your password? Please enter your email address. You will receive a link to create a new
                    password via email.</h2>

                <div class="form-group">
                    <input type="email" name="email" class="login-inputbox" placeholder="Enter email address" required
                           autofocus>
                </div>

                <button type="submit" class="login-submit">SUBMIT</button>
            </form>
        </div>
    </div>

    <div class="footer">Created by SSZ Solutions. © 2023</div>
</div>

</body>
</html>
