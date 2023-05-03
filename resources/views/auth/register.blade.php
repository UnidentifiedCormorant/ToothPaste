@extends('layouts.layout')
@section('content')

    <h2>Регистрация</h2>

    <form action="{{route('newUser')}}" method="post">
        @csrf
        <label for="login">Логин</label>
        <input name="login" type="text">

        <br>
        <label for="password">Пароль</label>
        <input name="password" type="password">

        <label for="password_confirmation">Подтвердить пароль</label>
        <input name="password_confirmation" type="password">

        <button type="submit">Войти</button>

    </form>
    @error('login')
    {{$message}}
    @enderror
    @error('password')
    {{$message}}
    @enderror

    <a href="{{route('login')}}">Назад</a>

@endsection
