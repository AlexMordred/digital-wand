<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_getting_reviewed_videos_that_are_not_yet_sent()
    {
        // A few videos that are reviewed but not sent
        $videos = factory('App\Video', 5)->create(['reviewed' => true]);

        // A few other videos
        factory('App\Video', 5)->create();

        $results = $this->getJson(route('api.videos'))
            ->assertStatus(200)
            ->json();

        $this->assertEquals($videos->toArray(), $results);
    }

    /** @test */
    public function test_limit_and_offset_query_parameters()
    {
        // We have 10 videos that are reviewed but not sent
        $videos = factory('App\Video', 10)->create(['reviewed' => true]);

        // Considering the query parameters...
        $endpoint = route('api.videos') . '?offset=3&limit=2';

        $results = $this->getJson($endpoint)
            ->assertStatus(200)
            ->json();

        // ...we expect videos with indexes 3-4 to be seen in the API response
        $this->assertCount(2, $results);

        $this->assertEquals($videos[3]['id'], $results[0]['id']);
        $this->assertEquals($videos[4]['id'], $results[1]['id']);
    }
}
