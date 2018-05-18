<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Linkthrow\Ffmpeg\Classes\FFMPEG;

class ConvertVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $video;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($video)
    {
        $this->video = $video;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $downloadedPath = storage_path('app/downloaded') . '/' . pathinfo($this->video['file_path'])['basename'];

        $convertedPath = storage_path('app/converted') . '/' . pathinfo($this->video['file_path'])['filename'] . '.mp4';

        $dir = storage_path('app/converted');

        if (!file_exists($dir)) {
            mkdir($dir);
        }

        // Convert the video
        FFMPEG::convert()
            ->input('"' . $downloadedPath . '"')
            ->bitrate(300, 'video')
            ->output('"' . $convertedPath . '"')
            ->go();

        // Delete the original file
        unlink($downloadedPath);
    }
}
