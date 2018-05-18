<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Video;

class AdminVideoAlterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_set_a_video_status_to_reviewed()
    {
        $video = factory('App\Video')->create();

        $this->assertFalse($video->reviewed);

        $this->actingAs($this->admin)
            ->postJson(route('admin.videos.set-reviewed', $video))
            ->assertStatus(200);

        $this->assertTrue($video->fresh()->reviewed);
    }

    /** @test */
    public function an_admin_can_delete_a_video()
    {
        Storage::fake('public');

        // Upload a fake video file as a user
        $data = [];

        $data = [
            'video' => $file = UploadedFile::fake()->create('video.mkv', 100)
        ];

        $this->actingAs($this->user)
            ->postJson(route('user.videos.store'), $data)
            ->assertStatus(201);

        $video = Video::first();

        Storage::disk('public')->assertExists($video->file_path);

        // Delete the video as an admin
        $this->actingAs($this->admin)
            ->deleteJson(route('admin.videos.destroy', $video))
            ->assertStatus(200);

        // Assert the video was deleted from the DB
        $this->assertDatabaseMissing('videos', ['id' => $video->id]);

        // Assert the video file was deleted
        Storage::disk('public')->assertMissing($video->file_path);
    }
}
