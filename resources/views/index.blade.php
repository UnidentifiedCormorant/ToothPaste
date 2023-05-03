@extends('layouts.layout')
@section('content')

    <h3>Это главная страница</h3>
    <a href="{{route('login')}}">Войти</a>
    <a href="{{route('register')}}">Зарегестрироватсья</a>

@auth()
Ну здарова {{auth()->user()->name}}
<a href="{{route('logout')}}">Выйти</a>
@endauth

@endsection
