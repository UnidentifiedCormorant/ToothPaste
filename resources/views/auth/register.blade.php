@extends('layouts.layout')
@section('content')

    <h2>Регистрация</h2>

    <form action="{{route('newUser')}}" method="post">
        @csrf
        <label for="name">Имя</label>
        <input name="name" type="text">

        <label for="email">Логин</label>
        <input name="email" type="text">

        <br>
        <label for="password">Пароль</label>
        <input name="password" type="password">

        <label for="password_confirmation">Подтвердить пароль</label>
        <input name="password_confirmation" type="password">

        <button type="submit">Войти</button>

    </form>
    @error('email')
    {{$message}}
    @enderror
    @error('password')
    {{$message}}
    @enderror

    <a href="{{route('login')}}">Назад</a>

@endsection
