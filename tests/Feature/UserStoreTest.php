<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserStoreTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admins_can_create_users()
    {
        $data = [
            'name' => 'User Name',
            'email' => $email = 'username@example.com',
            'password' => 'qwerty',
        ];

        $this->actingAs($this->admin)
            ->postJson(route('admin.users.store'), $data)
            ->assertStatus(201);

        $user = User::where('email', $email)->first();

        $this->assertNotNull($user);

        $this->assertEquals($data['name'], $user['name']);
        $this->assertEquals($data['email'], $user['email']);
        $this->assertTrue(Hash::check($data['password'], $user['password']));
    }

    /** @test */
    public function user_requires_a_name()
    {
        $this->withExceptionHandling();

        $this->actingAs($this->admin)
            ->postJson(route('admin.users.store'), [])
            ->assertStatus(422)
            ->assertJsonValidationErrors('name');
    }

    /** @test */
    public function user_requires_an_email()
    {
        $this->withExceptionHandling();

        $this->actingAs($this->admin)
            ->postJson(route('admin.users.store'), [])
            ->assertStatus(422)
            ->assertJsonValidationErrors('email');
    }

    /** @test */
    public function user_requires_a_password()
    {
        $this->withExceptionHandling();

        $this->actingAs($this->admin)
            ->postJson(route('admin.users.store'), [])
            ->assertStatus(422)
            ->assertJsonValidationErrors('password');
    }
}
