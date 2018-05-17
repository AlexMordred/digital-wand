<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VideoBrowseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function users_can_browse_videos()
    {
        factory('App\Video', 20)->create([
            'user_id' => $this->user->id
        ]);

        $results = $this->actingAs($this->user)
            ->getJson(route('user.videos.index'))
            ->assertStatus(200)
            ->json();

        $this->assertCount(10, $results['data']);
        $this->assertEquals(20, $results['total']);
    }

    /** @test */
    public function users_dont_see_videos_they_havent_uploaded_themselves()
    {
        factory('App\Video', 5)->create();

        $results = $this->actingAs($this->user)
            ->getJson(route('user.videos.index'))
            ->assertStatus(200)
            ->json();

        $this->assertCount(0, $results['data']);
        $this->assertEquals(0, $results['total']);
    }
}
