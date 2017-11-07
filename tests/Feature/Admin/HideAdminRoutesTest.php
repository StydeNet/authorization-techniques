<?php

namespace Tests\Feature\Admin;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HideAdminRoutesTest extends TestCase
{
    /** @test */
    function it_does_not_allow_guests_to_discover_admin_urls()
    {
        $this->get('admin/invalid-url')
            ->assertStatus(302)
            ->assertRedirect('admin/login');
    }

    /** @test */
    function it_does_not_allow_guests_to_discover_admin_urls_using_post()
    {
        $this->post('admin/invalid-url')
            ->assertStatus(302)
            ->assertRedirect('admin/login');
    }
    
    /** @test */
    function it_displays_404s_when_admins_visit_invalid_urls()
    {
        $this->actingAsAdmin()
            ->get('admin/invalid-url')
            ->assertStatus(404);
    }
}
