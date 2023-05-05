@extends('layouts.layout')
@section('content')

    <h2>{{$pasta->title}}</h2>

    <p>{{$pasta->content}}</p>

    <a href="#">ПОЖАЛОВАЦА</a>

    <p>Быстрая ссылка:</p>
    <p>http://127.0.0.1:8000/{{$pasta->hash}}</p>
    <br>
    <br>
    <a href="{{URL::previous()}}">Назад</a>
@endsection
