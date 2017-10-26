<?php

namespace Tests\Feature\Admin;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function admins_can_visit_the_admin_dashboard()
    {
        $admin = factory(User::class)->create([
            'role' => 'admin'
        ]);

        $this->actingAs($admin)
            ->get(route('admin_dashboard'))
            ->assertStatus(200)
            ->assertSee('Admin Panel');
    }

    /** @test */
    function non_admin_users_cannot_visit_the_admin_dashboard()
    {
        $user = factory(User::class)->create([
            'role' => 'client'
        ]);

        $this->actingAs($user)
            ->get(route('admin_dashboard'))
            ->assertStatus(403);
    }

    /** @test */
    function guests_cannot_visit_the_admin_dashboard()
    {
        $this->get(route('admin_dashboard'))
            ->assertStatus(302)
            ->assertRedirect('login');
    }
}
