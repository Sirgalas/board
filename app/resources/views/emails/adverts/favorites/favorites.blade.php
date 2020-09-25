@component('mail::message')
    # У объявления которое вы отобрали в избранное изменилась цена



    @component('mail::button', ['url' => route('register.verify', ['token' => $user->verify_token])])
        Verify Email
    @endcomponent

@endcomponent
