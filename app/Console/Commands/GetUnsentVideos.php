<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\DownloadVideo;

class GetUnsentVideos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'videos:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Get the list of videos that have been reviewed but haven't been sent yet";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->get(route('api.videos'))->getBody()->getContents();

        $videos = json_decode($response, true);

        // Enqueue a downloading job for each video
        foreach ($videos as $video) {
            DownloadVideo::dispatch($video)->onQueue('downloading');
        }
    }
}
