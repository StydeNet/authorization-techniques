<?php

namespace Tests;

use App\{User, Admin};
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function actingAsAdmin($admin = null)
    {
        if ($admin == null) {
            $admin = $this->createAdmin();
        }

        return $this->actingAs($admin, 'admin');
    }

    protected function actingAsUser($user = null)
    {
        if ($user == null) {
            $user = $this->createUser();
        }

        return $this->actingAs($user);
    }

    protected function createAdmin(array $attributes = [])
    {
        return factory(Admin::class)->create($attributes);
    }

    protected function createUser(array $attributes = [])
    {
        return factory(User::class)->create($attributes);
    }

    /**
     * Set the currently logged in user for the application.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  string|null  $driver
     * @return void
     */
    public function be(UserContract $user, $driver = null)
    {
        $this->app['auth']->guard($driver)->setUser($user);
    }
}
