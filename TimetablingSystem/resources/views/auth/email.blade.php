<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div>
        <label for="email">Email address:</label>
        <input type="email" name="email" id="email" required>
    </div>
    <button type="submit">Send password reset link</button>
</form>
