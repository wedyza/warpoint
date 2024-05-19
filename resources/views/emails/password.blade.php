@component('mail::message')
  Здравствуйте, чтобы войти нажмите на кнопку ниже:
  @component('mail::button', ['url' => $url])
    Click to login
  @endcomponent
  Не забудьте поменять пароль, если забыли свой!
@endcomponent