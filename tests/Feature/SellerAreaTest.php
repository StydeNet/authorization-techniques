<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SellerAreaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function sellers_can_visit_the_sellers_area()
    {
        $seller = factory(User::class)->create([
            'role' => 'seller'
        ]);

        $this->actingAs($seller)
            ->get(route('sellers'))
            ->assertStatus(200)
            ->assertSee('Sellers Area');
    }

    /** @test */
    function customers_cannot_visit_the_sellers_area()
    {
        $customer = factory(User::class)->create([
            'role' => 'customer'
        ]);

        $this->actingAs($customer)
            ->get(route('sellers'))
            ->assertStatus(403);
    }

    /** @test */
    function non_sellers_cannot_visit_the_sellers_area()
    {
        $user = factory(User::class)->create([
            'role' => false
        ]);

        $this->actingAs($user)
            ->get(route('sellers'))
            ->assertStatus(403);
    }

    /** @test */
    function guests_cannot_visit_the_sellers_area()
    {
        $this->get(route('sellers'))
            ->assertStatus(302)
            ->assertRedirect('login');
    }
}
