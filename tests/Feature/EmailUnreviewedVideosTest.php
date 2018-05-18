<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\UnreviewedVideos;

class EmailUnreviewedVideosTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_artisan_command_to_email_unreviewed_videos_to_the_admin()
    {
        Mail::fake();

        // A few videos that haven't been reviewed for over 3 days
        $videos = factory('App\Video', 5)->create([
            'created_at' => Carbon::now()->subDays(3)->subMinutes(1)
        ]);

        // A few fresher videos
        factory('App\Video', 5)->create();

        Artisan::call('videos:email:unreviewed');

        Mail::assertSent(UnreviewedVideos::class, function ($mail) use ($videos) {
            return $mail->videos->toArray() == $videos->toArray();
        });
    }
}
