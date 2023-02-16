<!-- forgot-password.blade.php -->

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/app.css">
    <title>Forgot Password</title>
</head>
<body>

<div class="login-page">
    <div class="login-content">
        <div class="login-column">
            <form  action="{{ route('password.email') }}" method="POST">
                @csrf

                <h1>Forgot Password</h1>
                <h2>Lost your password? Please enter your email address. You will receive a link to create a new password via email.</h2>

                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Enter email address" required autofocus>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <div class="footer">Created by SSZ Solutions. © 2023</div>
</div>

</body>
</html>
