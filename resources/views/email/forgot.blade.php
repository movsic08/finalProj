@component('mail::message')
Hello {{ $user->name }}

<p>We are the Shoeniverse Company</p>

@component('mail::button',['url' => route('account.resetPassword',$user->remember_token)])
  Reset your password 
@endcomponent

<p>Incase you have any issues recovering your password, please contact us</p>

Thanks, <br>
{{ config('app.name') }}

@endcomponent