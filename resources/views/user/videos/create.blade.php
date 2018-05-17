@extends('user.layout')

@section('title')
Личный кабинет - Видео - Загрузить видео
@endsection

@section('main')
<form action="{{ route('user.videos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group row">
        <label for="video" class="col-sm-4 col-form-label text-md-right">Видео файл</label>

        <div class="col-md-6">
            <input id="video"
                type="file"
                class="form-control{{ $errors->has('video') ? ' is-invalid' : '' }}"
                name="video"
                value="{{ old('video') }}"
                accept="video/*"
                required>

            @if ($errors->has('video'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('video') }}</strong>
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