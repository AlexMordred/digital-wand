<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Video;

class VideosController extends Controller
{
    public function index()
    {
        $query = Video::select();

        // Фильтры
        if (request()->has('sent') && request('sent') == 1) {
            $query->where('sent', true);
        }

        if (request()->has('reviewed') && request('reviewed') == 1) {
            $query->where('reviewed', true);
        }

        $videos = $query->paginate(10);

        return request()->wantsJson()
            ? $videos
            : view('admin.videos.index', compact('videos'));
    }

    public function destroy(Video $video)
    {
        $video->delete();

        return response()->json([]);
    }

    public function setReviewed(Video $video)
    {
        $video->reviewed = true;
        $video->save();

        return response()->json([]);
    }
}
