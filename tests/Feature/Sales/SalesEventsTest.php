<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesEventsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function seller_user_can_visit_the_sales_events_page()
    {
        $seller = factory(User::class)->create([
            'role' => 'seller'
        ]);

        $this->actingAs($seller)
            ->get(route('sales_events'))
            ->assertStatus(200)
            ->assertSee('Sales Events');
    }

    /** @test */
    function client_users_cannot_visit_the_sales_events_page()
    {
        $client = factory(User::class)->create([
            'role' => 'client'
        ]);

        $this->actingAs($client)
            ->get(route('sales_events'))
            ->assertStatus(403);
    }

    /** @test */
    function guests_cannot_visit_the_sales_events_page()
    {
        $this->get(route('sales_events'))
            ->assertStatus(302)
            ->assertRedirect('login');
    }
}
