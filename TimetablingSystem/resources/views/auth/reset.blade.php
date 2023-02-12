<!-- resources/views/auth/passwords/reset.blade.php -->
<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <div>
        <label for="email">Email address:</label>
        <input type="email" name="email" id="email" value="{{ $email ?? old('email') }}" required>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
    </div>
    <div>
        <label for="password_confirmation">Confirm password:</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>
    </div>
    <button type="submit">Reset password</button>
</form>
