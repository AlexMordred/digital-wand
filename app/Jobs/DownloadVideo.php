<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DownloadVideo implements ShouldQueue
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
        $dir = storage_path('app/downloaded');

        if (!file_exists($dir)) {
            mkdir($dir);
        }

        $path = $dir . '/' . pathinfo($this->video['file_path'])['basename'];

        $client = new \GuzzleHttp\Client();

        // Download the video
        $client->get($this->video['download_url'], ['sink' => $path]);

        // Notify the main app, mark the video as "sent"
        $client->post(route('api.videos.mark-as-sent', $this->video['id']));

        // Enqueue a job to convert the video
    }
}
