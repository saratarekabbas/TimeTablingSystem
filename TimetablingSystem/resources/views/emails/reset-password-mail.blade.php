<x-mail::message>
# TtS Reset Password Request

    Please click on the following link to reset your password. <br>Ignore this email if you have not requested password reset.
    <x-mail::button :url="route('password.reset', ['token' => $token])">
        Reset Password
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
