<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Video;

class ApiController extends Controller
{
    public function videos()
    {
        $query = Video::where('sent', false)
            ->where('reviewed', true);

        // Query parameters
        if (request()->has('limit')) {
            $query->take(request('limit'));
        }

        if (request()->has('offset') && request()->has('limit')) {
            $query->skip(request('offset'));
        }

        $videos = $query->get();

        return $videos;
    }

    public function markAsSent(Video $video)
    {
        $video->sent = true;
        $video->save();

        return response()->json([]);
    }
}
