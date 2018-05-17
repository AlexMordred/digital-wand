<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Video;

class VideoStoreTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function users_can_upload_videos()
    {
        Storage::fake('public');

        $this->assertEquals(0, Video::count());

        $data = [
            'video' => $file = UploadedFile::fake()->create('video.mkv', 100)
        ];

        $this->actingAs($this->user)
            ->postJson(route('user.videos.store'), $data)
            ->assertStatus(201);

        $this->assertEquals(1, Video::count());

        $video = Video::first();
        $videoPath = 'videos/' . $file->hashName();

        $this->assertEquals($this->user->id, $video['user_id']);
        $this->assertEquals($videoPath, $video['file_path']);

        Storage::disk('public')->assertExists($videoPath);
    }

    /** @test */
    public function users_can_only_upload_one_video_per_7_days()
    {
        $this->withExceptionHandling();

        // A user already has uploaded a video within the last 7 days
        factory('App\Video')->create([
            'user_id' => $this->user->id
        ]);

        // Try to upload another video - expect an error
        $data = [
            'video' => $file = UploadedFile::fake()->create('video.mkv', 100)
        ];

        $this->actingAs($this->user)
            ->postJson(route('user.videos.store'), $data)
            ->assertStatus(422);

        // Assert there's still only one video in the DB
        $this->assertEquals(1, Video::count());
    }
}
