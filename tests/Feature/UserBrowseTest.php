<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserBrowseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admins_can_browse_users()
    {
        // 19 + 1 user is created for each test
        factory('App\User', 19)->create();

        $results = $this->actingAs($this->admin)
            ->getJson(route('admin.users.index'))
            ->assertStatus(200)
            ->json();

        $this->assertCount(10, $results['data']);
        $this->assertEquals(20, $results['total']);
    }
}
