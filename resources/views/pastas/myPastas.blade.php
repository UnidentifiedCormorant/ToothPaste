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
                <td><a href="{{route('show', $pasta->hash)}}">{{route('show', $pasta->hash)}}</a></td>
                <td>{{\App\Domain\Enum\AccessType::from($pasta->access_type)->value}}</td>
            </tr>
        @endforeach
    </table>
    <br>
    <a href="{{route('pastas.index')}}">Назад</a>

    {{ $pastas->links() }}

@endsection
