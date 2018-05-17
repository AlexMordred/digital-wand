<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminVideoBrowseTest extends TestCase
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
        // // Create 10 videos with "sent = false"
        // factory('App\Video', 10)->create();
        // // Create one video with "sent = true"
        // factory('App\Video')->create(['sent' => true]);

        // $results = $this->actingAs($this->admin)
        //     ->getJson(route('admin.videos.index') . '?sent=1')
        //     ->assertStatus(200)
        //     ->json();

        // // Only one video should be returned
        // $this->assertCount(1, $results['data']);
        // $this->assertEquals(1, $results['total']);

        // TODO: verify the file was deleted
    }
}
