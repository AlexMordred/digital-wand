@extends('admin.layout')

@section('title')
Личный кабинет - Видео - Загрузить видео
@endsection

@section('main')
<form action="{{ route('admin.users.store') }}" method="POST">
    @csrf

    <div class="form-group row">
        <label for="name" class="col-sm-4 col-form-label text-md-right">Имя</label>

        <div class="col-md-6">
            <input id="name"
                type="text"
                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                name="name"
                value="{{ old('name') }}"
                required>

            @if ($errors->has('name'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail</label>

        <div class="col-md-6">
            <input id="email"
                type="text"
                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                name="email"
                value="{{ old('email') }}"
                required>

            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-sm-4 col-form-label text-md-right">Пароль</label>

        <div class="col-md-6">
            <input id="password"
                type="text"
                class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                name="password"
                value="{{ old('password') }}"
                required>

            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-8 offset-md-4">
            <button type="submit" class="btn btn-primary">
                Загрузить
            </button>
        </div>
    </div>
</form>
@endsection