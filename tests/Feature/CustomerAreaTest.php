<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerAreaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function customers_can_visit_the_customers_area()
    {
        $customer = factory(User::class)->create([
            'customer' => true
        ]);

        $this->actingAs($customer)
            ->get(route('customers'))
            ->assertStatus(200)
            ->assertSee('Customers Area');
    }

    /** @test */
    function sellers_cannot_visit_the_customers_area()
    {
        $seller = factory(User::class)->create([
            'seller' => true
        ]);

        $this->actingAs($seller)
            ->get(route('customers'))
            ->assertStatus(403);
    }

    /** @test */
    function non_customers_cannot_visit_the_customers_area()
    {
        $user = factory(User::class)->create([
            'customer' => false
        ]);

        $this->actingAs($user)
            ->get(route('customers'))
            ->assertStatus(403);
    }

    /** @test */
    function guests_cannot_visit_the_customers_area()
    {
        $this->get(route('customers'))
            ->assertStatus(302)
            ->assertRedirect('login');
    }
}
