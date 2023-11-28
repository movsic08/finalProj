@component('mail::message')
Hello Admin

@component('mail::button',['url' => route('admin.resetPassword',$user->remember_token)])
  Reset your password 
@endcomponent

<p>Incase you have any issues recovering your password, please contact us</p>

Thanks, <br>
{{ config('app.name') }}

@endcomponent