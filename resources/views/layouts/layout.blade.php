<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ToothPaste</title>
</head>
<body>

<h1>ToothPaste</h1>

<h2>Последние пасты</h2>
@foreach($lastPastas as $lPasta)
    <a href="{{route('show', $lPasta->hash)}}">{{$lPasta->title}}</a>
@endforeach
<br>
@auth()
    <h2>МОИ последние пасты</h2>
    @foreach($myPastas as $pasta)
        <a href="{{route('show', $pasta->hash)}}">{{$pasta->title}}</a>
    @endforeach
    <br>
    <a href="{{route('pastas.myPastas')}}">МОИ ПАСТЫ</a>
@endauth
<br>
@if(!\Illuminate\Support\Facades\Auth::check())
    <a href="{{route('login')}}">Войти</a>
    <a href="{{route('register')}}">Зарегестрироватсья</a>
@endif
<br>
@auth()
    Ну здарова {{auth()->user()->name}}
    <a href="{{route('logout')}}">Выйти</a>
    @if(Auth::user()->hasAccess('*'))
        <a href="{{route('platform.main')}}">Перейти в админ-панель</a>
    @endif
@endauth
<br>
@yield('content')

</body>
</html>
