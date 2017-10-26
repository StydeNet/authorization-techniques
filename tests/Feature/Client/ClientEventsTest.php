<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientEventsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function client_can_visit_the_client_events_page()
    {
        $client = factory(User::class)->create([
            'role' => 'client'
        ]);

        $this->actingAs($client)
            ->get(route('client_events'))
            ->assertStatus(200)
            ->assertSee('Client Events');
    }

    /** @test */
    function seller_users_cannot_visit_the_client_events_page()
    {
        $seller = factory(User::class)->create([
            'role' => 'seller'
        ]);

        $this->actingAs($seller)
            ->get(route('client_events'))
            ->assertStatus(403);
    }

    /** @test */
    function guests_cannot_visit_the_admin_events_page()
    {
        $this->get(route('client_events'))
            ->assertStatus(302)
            ->assertRedirect('login');
    }
}
