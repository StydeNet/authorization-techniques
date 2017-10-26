<?php

namespace Tests\Feature\Client;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientDashboardTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function clients_can_visit_the_client_dashboard()
    {
        $client = factory(User::class)->create([
            'role' => 'client'
        ]);

        $this->actingAs($client)
            ->get(route('client_dashboard'))
            ->assertStatus(200)
            ->assertSee('Client Panel');
    }

    /** @test */
    function seller_users_cannot_visit_the_client_dashboard()
    {
        $seller = factory(User::class)->create([
            'role' => 'seller'
        ]);

        $this->actingAs($seller)
            ->get(route('client_dashboard'))
            ->assertStatus(403);
    }

    /** @test */
    function guests_cannot_visit_the_admin_dashboard()
    {
        $this->get(route('client_dashboard'))
            ->assertStatus(302)
            ->assertRedirect('login');
    }

}
