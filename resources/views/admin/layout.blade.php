@extends('layouts.app') 

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <h3>Меню</h3>

            <nav class="nav flex-column">
                <a class="nav-link" href="{{ route('admin.users.index') }}">Пользователи</a>
            </nav>
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">@yield('title')</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @yield('main')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection