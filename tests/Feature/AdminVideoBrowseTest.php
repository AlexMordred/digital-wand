<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminVideoBrowseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_browse_all_existing_videos()
    {
        factory('App\Video', 20)->create();

        $results = $this->actingAs($this->admin)
            ->getJson(route('admin.videos.index'))
            ->assertStatus(200)
            ->json();

        $this->assertCount(10, $results['data']);
        $this->assertEquals(20, $results['total']);
    }

    /** @test */
    public function video_can_be_filtered_by_sent_status()
    {
        // Create 10 videos with "sent = false"
        factory('App\Video', 10)->create();
        // Create one video with "sent = true"
        factory('App\Video')->create(['sent' => true]);

        $results = $this->actingAs($this->admin)
            ->getJson(route('admin.videos.index') . '?sent=1')
            ->assertStatus(200)
            ->json();

        // Only one video should be returned
        $this->assertCount(1, $results['data']);
        $this->assertEquals(1, $results['total']);
    }

    /** @test */
    public function video_can_be_filtered_by_reviewed_status()
    {
        // Create 10 videos with "reviewed = false"
        factory('App\Video', 10)->create();
        // Create one video with "reviewed = true"
        factory('App\Video')->create(['reviewed' => true]);

        $results = $this->actingAs($this->admin)
            ->getJson(route('admin.videos.index') . '?reviewed=1')
            ->assertStatus(200)
            ->json();

        // Only one video should be returned
        $this->assertCount(1, $results['data']);
        $this->assertEquals(1, $results['total']);
    }
}
