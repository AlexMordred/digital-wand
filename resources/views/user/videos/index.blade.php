@extends('user.layout')

@section('title')
Личный кабинет - Видео
[<a href="{{ route('user.videos.create') }}">Загрузить видео</a>]
@endsection

@section('main')
<table class="table stripped">
    <thead>
        <th>Оригинальное название файла</th>
        <th>Дата загрузки</th>
        <th>Статус</th>
    </thead>

    <tbody>
        @forelse ($videos as $video)
            <tr>
                <td>{{ $video->original_filename }}</td>
                <td>{{ $video->created_at->format('d.m.Y, H:i:s') }} UTC</td>
                <td>{{ $video->reviewed ? 'Проверено' : 'На модерации' }}</td>
            </tr>
        @empty
            <tr>
                <td>
                    Вы не загрузили ни одного видео.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

{{ $videos->links() }}
@endsection