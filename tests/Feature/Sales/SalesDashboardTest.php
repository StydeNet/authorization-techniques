<?php

namespace Tests\Feature\Admin;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesDashboardTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function seller_user_can_visit_the_sales_dashboard()
    {
        $seller = factory(User::class)->create([
            'role' => 'seller'
        ]);

        $this->actingAs($seller)
            ->get(route('sales_dashboard'))
            ->assertStatus(200)
            ->assertSee('Sales Panel');
    }

    /** @test */
    function admin_user_can_visit_the_sales_dashboard()
    {
        $admin = factory(User::class)->create([
            'role' => 'admin'
        ]);

        $this->actingAs($admin)
            ->get(route('sales_dashboard'))
            ->assertStatus(200)
            ->assertSee('Sales Panel');
    }

    /** @test */
    function client_users_cannot_visit_the_sales_dashboard()
    {
        $client = factory(User::class)->create([
            'role' => 'client'
        ]);

        $this->actingAs($client)
            ->get(route('sales_dashboard'))
            ->assertStatus(403);
    }

    /** @test */
    function guests_cannot_visit_the_sales_dashboard()
    {
        $this->get(route('sales_dashboard'))
            ->assertStatus(302)
            ->assertRedirect('login');
    }

}
