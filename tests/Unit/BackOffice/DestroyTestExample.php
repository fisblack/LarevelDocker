<?php

namespace Tests\Unit\BackOffice\Example;

use Tests\TestCase;
use Faker\Generator as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleDestroyTest extends TestCase
{
    use RefreshDatabase;

    public function testCaseExample()
    {
        $user = User::first();
        
        $user->delete(); // SoftDelete
        $result = $user->delete(); // ForceDelete

        $this->assertTrue($result);
    }
}
