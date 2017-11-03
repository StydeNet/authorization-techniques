<?php

namespace Tests;

use App\{User, Admin};
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function createAdmin()
    {
        return factory(Admin::class)->create([
            'admin' => true
        ]);
    }

    protected function createUser()
    {
        return factory(User::class)->create([
            'admin' => false
        ]);
    }
}
