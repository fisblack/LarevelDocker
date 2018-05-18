<?php

namespace Tests\Unit\BackOffice\Example;

use Tests\TestCase;
use Faker\Generator as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleRestoreTest extends TestCase
{
    use RefreshDatabase;

    public function testCaseExample()
    {
        $user = User::first();
        
        $user->delete();
        $result = $user->restore();
        
        $this->assertTrue($result);
    }
}
