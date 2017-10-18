<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChangePasswordTest extends TestCase
{
    /** @test */
    function it_shows_the_page_to_authenticated_users()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('change_password'))
            ->assertStatus(200)
            ->assertSee('Change Password');
    }

    /** @test */
    function it_redirects_guest_users_to_the_login_page()
    {
        $this->get(route('change_password'))
            ->assertStatus(302)
            ->assertRedirect('login');
    }
}
