@extends('admin.layout')

@section('title')
Панель администратора - Пользователи
[<a href="{{ route('admin.users.create') }}">Добавить пользователя</a>]
@endsection

@section('main')
<table class="table stripped">
    <thead>
        <th>Имя</th>
        <th>E-Mail</th>
    </thead>

    <tbody>
        @forelse ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
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

{{ $users->links() }}
@endsection