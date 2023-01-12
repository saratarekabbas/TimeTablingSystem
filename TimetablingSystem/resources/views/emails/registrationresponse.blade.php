<x-mail::message>
# Welcome to TtS System

Your registration request have been approved. You can use your credentials to log into your account now.

<x-mail::button :url="'/'">
Login
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
