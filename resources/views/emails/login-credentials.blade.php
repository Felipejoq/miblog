@component('mail::message')
# Datos para que ingreses al blog

Usa las siguientes credenciales para entrar al blog.

@component('mail::table')
    | Usuario | Contraseña |
    |:---------|:------------|
    | {{ $user->email }} | {{ $password }} |
@endcomponent

@component('mail::button', ['url' => url('login')])
Conectarse
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
