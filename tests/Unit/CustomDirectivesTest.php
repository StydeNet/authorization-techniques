<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Support\Facades\Blade;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomDirectivesTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function an_unauthenticated_user_return_false()
    {
        $this->assertFalse(Blade::check('admin'));
    }

    /** @test */
    public function non_admin_user_return_false()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->assertFalse(Blade::check('admin'));
    }

    /** @test */
    public function admin_user_return_true()
    {
        $admin = factory(User::class)->create(['admin' => true]);

        $this->actingAs($admin)
            ->assertTrue(Blade::check('admin'));
    }
}
