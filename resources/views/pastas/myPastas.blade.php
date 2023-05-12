@extends('layouts.layout')
@section('content')

    <table>
        <tr>
            <th>Название</th>
            <th>Ссылка</th>
            <th>Ограничение доступа</th>
        </tr>
        @foreach($pastas as $pasta)
            <tr>
                <td>{{$pasta->title}}</td>
                <td><a href="{{route('pastas.show', $pasta->hash)}}">{{route('pastas.show', $pasta->hash)}}</a></td>
                <td>{{$pasta->accessType->title}}</td>
            </tr>
        @endforeach
    </table>
    <br>
    <a href="{{route('index')}}">Назад</a>

    {{ $pastas->links() }}

@endsection
