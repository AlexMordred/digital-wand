<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Queue;
use App\Jobs\DownloadVideo;

class ConverterServerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_converter_server_may_request_the_list_of_unsent_videos()
    {
        Queue::fake();

        $video = factory('App\Video')->create(['reviewed' => true]);

        Artisan::call('videos:list');

        // Assert the jobs for the newly received videos were scheduled
        Queue::assertPushed(DownloadVideo::class, function ($job) use ($video) {
            return $job->video['id'] == $video->id;
        });
    }
}
