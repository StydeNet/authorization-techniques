<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_shows_the_dashboard_page_to_authenticated_users()
    {
        $this->withoutExceptionHandling();

        $this->actingAsUser()
            ->get(route('home'))
            ->assertStatus(200)
            ->assertSee('Dashboard');
    }

    /** @test */
    function it_shows_the_dashboard_page_to_admins()
    {
        $this->withoutExceptionHandling();

        $this->actingAsAdmin()
            ->get(route('home'))
            ->assertStatus(200)
            ->assertSee('Dashboard');
    }
    
    /** @test */
    function it_redirects_guest_users_to_the_login_page()
    {
        $this->get(route('home'))
            ->assertStatus(302)
            ->assertRedirect('login');
    }
}
