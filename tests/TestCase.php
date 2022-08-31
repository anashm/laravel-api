<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    const HTTP_OK = 200;
    const HTTP_CREATED = 201;
    const HTTP_ERROR = 500;
    const HTTP_NOT_FOUND = 405;

     public function createUser($args = [])
    {
        return User::factory()->create($args);
    }
}
