@extends('layouts.layout')
@section('content')

<h2>Авторизация</h2>
<form action="{{route('auth')}}" method="post">
    @csrf
    <label for="login">Логин</label>
    <input name="login" type="text">
    <br>
    <label for="password">Пароль</label>
    <input name="password" type="password">

    <button type="submit">Войти</button>
</form>

@error('login')
{{$message}}
@enderror
@error('password')
{{$message}}
@enderror

<a href="{{route('register')}}">Нет учётной записи? Зарегестрируйтесь</a>

@endsection
