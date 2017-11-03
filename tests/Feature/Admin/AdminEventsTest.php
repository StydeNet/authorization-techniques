<?php

namespace Tests\Feature\Admin;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminEventsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function admins_can_visit_the_admin_events_page()
    {
        $this->actingAs($this->createAdmin())
            ->get(route('admin_events'))
            ->assertStatus(200)
            ->assertSee('Admin Events');
    }

    /** @test */
    function non_admin_users_cannot_visit_the_admin_events_page()
    {
        $this->actingAs($this->createUser())
            ->get(route('admin_events'))
            ->assertStatus(403);
    }

    /** @test */
    function guests_cannot_visit_the_admin_events_page()
    {
        $this->get(route('admin_events'))
            ->assertStatus(302)
            ->assertRedirect('login');
    }
}
