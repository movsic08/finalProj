@component('mail::message')
Hello {{ $user->name }}

@component('mail::button',['url' => route('account.emailVerified',$user->remember_token)])
  Verify your email
@endcomponent

<p>Click the button above to verify your email</p>

Thanks, <br>
{{ config('app.name') }}

@endcomponent