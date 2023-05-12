@extends('layouts.layout')
@section('content')

    <h2>{{$pasta->title}}</h2>

    <p>{{$pasta->content}}</p>

    <a href="{{route('complaints.create', $pasta->id)}}}">ПОЖАЛОВАЦА</a>

    <p>Быстрая ссылка:</p>
    <p>{{route('pastas.show', $pasta->hash)}}</p>
    <br>
    <br>
    <a href="{{URL::previous()}}">Назад</a>
@endsection
