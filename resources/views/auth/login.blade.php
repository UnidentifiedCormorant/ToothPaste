@extends('layouts.layout')
@section('content')

<h2>Авторизация</h2>
<form action="{{route('auth')}}" method="post">
    @csrf
    <label for="email">Логин</label>
    <input name="email" type="text">
    <br>
    <label for="password">Пароль</label>
    <input name="password" type="password">

    <button type="submit">Войти</button>
</form>

@error('email')
{{$message}}
@enderror
@error('password')
{{$message}}
@enderror

<a href="{{route('register')}}">Нет учётной записи? Зарегестрируйтесь</a>

<a href="{{route('pastas.index')}}">Назад</a>

@endsection
