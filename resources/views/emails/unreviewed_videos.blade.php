@component('mail::message')
# Видео

Список неотмодерированных видео. которые были загружены больше 3х дней назад.

@foreach ($videos as $video)
<p>
    <a href="{{ asset('storage/' . $video->file_path) }}" target="_blank">{{ asset('storage/' . $video->file_path) }}</a>
</p>
@endforeach
@endcomponent
