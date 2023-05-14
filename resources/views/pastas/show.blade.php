@extends('layouts.layout')
@section('content')

    <h2>{{$pasta->title}}</h2>

    <p>{!! $pasta->content !!}</p>

    <a href="{{route('complaints.create', $pasta->id)}}}">ПОЖАЛОВАЦА</a>

    <p>Быстрая ссылка:</p>
    <h2>{{route('pastas.show', $pasta->hash)}}</h2>
    <br>
    <br>
    <a href="{{route('index')}}">Назад</a>
@endsection
