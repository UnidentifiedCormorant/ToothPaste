@extends('layouts.layout')
@section('content')

    <h3>Это главная страница</h3>

    <p>СОЗДАТЬ ПАСТУ</p>
    <form action="{{route('pastas.store')}}" method="post">
        @csrf
        <label for="title">Название</label>
        <input name="title" type="text">

        <label for="content">Содержание</label>
        <textarea name="content" type="text"></textarea>

        <label for="expiration_time">Время существования</label>
        <select name="expiration_time">
            @foreach(\App\Domain\Enum\ExpirationTime::cases() as $time)
                <option value="{{$time->value}}">{{$time->title()}}</option>
            @endforeach
        </select>

        <label for="access_type">Тип доступа</label>
        <select name="access_type">
            @foreach(\App\Domain\Enum\AccessType::cases() as $accessType)
                @if($accessType == \App\Domain\Enum\AccessType::Private && !\Illuminate\Support\Facades\Auth::check())
                @else
                    <option value="{{$accessType->value}}">{{$accessType->title()}}</option>
                @endif
            @endforeach
        </select>

        <label for="language">Язык</label>
        <select name="language">
            <option value="ru">Русский</option>
            <option value="en">Английский</option>
        </select>

        <button type="submit">Добавить</button>
    </form>

@endsection
