<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Video;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class VideosController extends Controller
{
    public function store()
    {
        $this->validator(request()->all())->validate();

        $file = request()->file('video');

        $path = $file->store('videos', 'public');

        $video = Video::create([
            'user_id' => auth()->id(),
            'file_path' => $path,
            'original_filename' => $file->getClientOriginalName()
        ]);

        return request()->wantsJson()
            ? $video
            : redirect()->route('user.videos.index')
                ->with('status', 'Видео было успешно загружено!');
    }

    public function validator($data)
    {
        $validator = Validator::make($data, [
            'video' => 'required|file|mimes:avi,mp4,mkv'
        ]);

        $validator->after(function ($validator) {
            // Пользователь не может загружать больше 1 видео в течение 7 дней
            $exists = Video::where('user_id', auth()->id())
                ->where('created_at', '>=', Carbon::now()->subDays(7))
                ->exists();

            if ($exists) {
                $validator->errors()->add(
                    'video',
                    'Нельзя загружать больше одного видео в течение 7 дней.'
                );
            }
        });

        return $validator;
    }

    public function index()
    {
        $videos = Video::where('user_id', auth()->id())->paginate(10);

        return request()->wantsJson()
            ? $videos
            : view('user.videos.index', compact('videos'));
    }

    public function create()
    {
        return view('user.videos.create');
    }
}
