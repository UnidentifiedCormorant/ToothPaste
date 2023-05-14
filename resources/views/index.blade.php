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

        <label for="expirationTime">Время существования</label>
        <select name="expirationTime">
            <option value="">Без ограничения</option>
            <option value="10">10 минут</option>
            <option value="60">1 час</option>
            <option value="180">3 часа</option>
            <option value="1440">1 день</option>
            <option value="10080">1 неделя</option>
            <option value="43200">1 месяц</option>
        </select>

        <label for="access_type_id">Тип доступа</label>
        <select name="access_type_id">
            @foreach($accessTypes as $accessType)
                @if($accessType->id == 3 && !\Illuminate\Support\Facades\Auth::check())
                @else
                    <option value="{{$accessType->id}}">{{$accessType->title}}</option>
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
