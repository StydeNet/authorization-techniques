<?php

namespace Tests\Feature\Admin;

use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminLogoutTest extends TestCase
{
    /** @test */
    function an_admin_can_logout()
    {
        // Having / Given / Arrange
        auth('admin')->login($this->createAdmin());

        $this->assertAuthenticated('admin');

        // When / Act
        $response = $this->post('admin/logout');

        // Then / Assert
        $response->assertRedirect('/');

        $this->assertGuest('admin');
    }

    /** @test */
    function logging_out_as_an_admin_does_not_terminate_the_user_session()
    {
        // Having / Given / Arrange
        auth('admin')->login($this->createAdmin());
        auth('web')->login($this->createUser());

        $adminSessionName = auth('admin')->getName();
        $webSessionName = auth('web')->getName();

        $this->assertAuthenticated('admin');
        $this->assertAuthenticated('web');

        // When / Act
        $response = $this->post('admin/logout');

        // Then / Assert
        $response->assertRedirect('/')
            ->assertSessionHas($webSessionName)
            ->assertSessionMissing($adminSessionName);

        $this->assertGuest('admin');
        $this->assertAuthenticated('web');
    }
}
