@extends('user.layout')

@section('title')
Личный кабинет - Видео
[<a href="{{ route('user.videos.create') }}">Загрузить видео</a>]
@endsection

@section('main')
Список видео
@endsection