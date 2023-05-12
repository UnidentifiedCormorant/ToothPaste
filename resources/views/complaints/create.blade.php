@extends('layouts.layout')
@section('content')

    <h3>Паста, что вам не понравилась</h3>
    <label for="">{{$pasta->title}}</label>
    <p>{{$pasta->content}}</p>

    <form action="{{route('complaints.store')}}" method="post">
        @csrf
        <label for="title">Содержание жалобы</label>
        <textarea name="content"></textarea>

        <input name="pasta_id" type="hidden" value="{{$pasta->id}}">

        <button type="submit">Отправить жалобу</button>
    </form>

    <a href="{{route('index')}}">Назад</a>


@endsection
