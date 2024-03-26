<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{

    protected $seed = true;

    protected function setUp(): void
    {

        parent::setUp();

        $this->actingAs(User::find(1));
    }
}
