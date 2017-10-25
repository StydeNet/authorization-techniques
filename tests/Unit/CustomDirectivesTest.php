<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Blade;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomDirectivesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertFalse(Blade::check('admin'));
    }
}
