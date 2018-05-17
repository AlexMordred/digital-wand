<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp()
    {
        parent::setUp();

        $this->withoutExceptionHandling();

        $this->user = factory('App\User')->create(['role' => User::ROLE_USER]);
        $this->admin = factory('App\User')->create(['role' => User::ROLE_ADMIN]);
    }
}
