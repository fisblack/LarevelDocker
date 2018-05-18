<?php

namespace Tests\Unit\BackOffice\Example;

use Tests\TestCase;
use Faker\Generator as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function testCaseExample()
    {
        $user = User::first();
        $result = $user->delete();
        $this->assertTrue($result);
    }
}
